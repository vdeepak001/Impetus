<?php

namespace App\Livewire\Frontend;

use App\Enums\CourseTestType;
use App\Models\CourseDetail;
use App\Models\CourseQuestion;
use App\Models\CourseTestAnswer;
use App\Models\CourseTestAttempt;
use App\Models\QuestionSplitUp;
use App\Services\CourseQuestionSplitResolver;
use App\Services\CourseStateCouncilResolver;
use App\Services\CourseTestAuthorizer;
use App\Services\CourseTestQuestionSelector;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CourseTestTaking extends Component
{
    private const EXAM_TIME_LIMIT_MINUTES = 45;

    public int $courseId;

    public string $testType = 'mock';

    public CourseTestType $type;

    /** @var list<array{id:int,num:int,text:string|null,choices:array{a:?string,b:?string,c:?string,d:?string},level:?string}> */
    public array $questions = [];

    /** @var array<int, string|null> question_id => a|b|c|d */
    public array $responses = [];

    public int $currentIndex = 0;

    public ?int $attemptId = null;

    public bool $submitted = false;

    public ?float $scorePercent = null;

    public ?bool $passed = null;

    public ?float $passThresholdPercent = null;

    public int $correctCount = 0;
    
    public int $obtainedScore = 0;
    
    public int $maxScore = 0;
    
    public ?int $rating = null;

    public int $finalAttemptCount = 0;

    public int $totalQuestions = 0;

    /** @var array<int, array{correct:int, total:int, weight:int, score:int, max:int}> */
    public array $levelStats = [];

    public ?int $practiceLevel = null;
    public ?int $practiceSet = null;
    public int $currentAttemptNumber = 1;
    public ?int $orderId = null;

    public ?string $fatalError = null;

    /** H:mm:ss or m:ss from attempt timestamps after submit. */
    public ?string $formattedDuration = null;

    public ?string $submitError = null;

    /** Unix timestamp when the 45-minute exam window ends (from attempt started_at). */
    public ?int $examDeadlineTs = null;

    public string $examTimerDisplay = '45:00';

    public bool $examTimeExpired = false;

    /** Seconds left in the exam window (for UI states). */
    public int $examSecondsRemaining = 0;

    /** @var array<int, string> question_id => 'correct'|'wrong_first'|'wrong_second'|null */
    public array $practiceResults = [];

    /** @var array<int, int> question_id => attempt_count */
    public array $practiceAttempts = [];

    /** @var array<int, bool> question_id => show_reasoning */
    public array $practiceShowReasoning = [];

    /** @var array<int, string|null> question_id => reasoning text */
    public array $practiceReasoning = [];

    /** @var array<int, string|null> question_id => correct answer letter */
    public array $practiceCorrectAnswers = [];

    /** @var array<int, string|null> question_id => choice letter (a|b|c|d) */
    public array $practiceFirstWrongAnswer = [];

    public function mount(int $courseId, string $testType): void
    {
        $this->courseId = $courseId;
        $this->testType = $testType;
        $course = CourseDetail::query()->findOrFail($courseId);
        $this->type = CourseTestType::from($testType);

        $user = auth()->user();
        abort_unless($user, 403);

        app(CourseTestAuthorizer::class)->ensureCanAccess($user, $course, $this->type);

        $council = app(CourseStateCouncilResolver::class)->resolveForUserCourse($user, $course);
        $split = app(CourseQuestionSplitResolver::class)->resolve($council, $course);

        $level = request()->query('level') ? (int) request()->query('level') : null;
        $set = request()->query('set') ? (int) request()->query('set') : null;
        $this->practiceLevel = $level;
        $this->practiceSet = $set;

        if ($this->type === CourseTestType::Practice && $level !== null && $set !== null) {
            $this->currentAttemptNumber = (int) CourseTestAttempt::query()
                ->where('user_id', $user->id)
                ->where('course_detail_id', $course->id)
                ->where('test_type', CourseTestType::Practice->value)
                ->where('practice_level', $level)
                ->where('practice_set', $set)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->count() + 1;
        }

        $selector = app(CourseTestQuestionSelector::class);
        $ids = $selector->selectQuestionIds($course, $split, $this->type, $level, $set);

        if ($ids === []) {
            $this->fatalError = $this->buildNoQuestionsMessage($course, $split, $selector);

            return;
        }

        $inProgress = CourseTestAttempt::query()
            ->where('user_id', $user->id)
            ->where('course_detail_id', $course->id)
            ->where('test_type', $this->type->value)
            ->where('status', CourseTestAttempt::STATUS_IN_PROGRESS)
            ->latest('id')
            ->first();

        $resume = $inProgress && $this->shouldResumeInProgressAttempt(request()->header('Referer'));

        if ($resume) {
            $this->attemptId = $inProgress->id;
            $ids = $inProgress->question_ids;
            $this->hydrateQuestionsPayload($ids);
            
            if ($this->type === CourseTestType::Practice) {
                $this->initPracticeStates($ids);
            }
            
            $this->hydrateResponsesFromAttempt($inProgress);
            $this->currentIndex = (int) ($inProgress->last_index ?? 0);
        } else {
            if ($inProgress) {
                $inProgress->delete();
            }

            if ($this->type !== CourseTestType::Practice) {
                shuffle($ids);
            }

            $attempt = CourseTestAttempt::query()->create([
                'user_id' => $user->id,
                'course_detail_id' => $course->id,
                'state_council_id' => $council?->id,
                'test_type' => $this->type,
                'practice_level' => request()->query('level'),
                'practice_set' => request()->query('set'),
                'status' => CourseTestAttempt::STATUS_IN_PROGRESS,
                'question_ids' => $ids,
                'correct_count' => 0,
                'total_questions' => count($ids),
                'started_at' => now(),
            ]);
            $this->attemptId = $attempt->id;
            $this->hydrateQuestionsPayload($ids);
            $this->initEmptyResponses($ids);

            if ($this->type === CourseTestType::Practice) {
                $this->initPracticeStates($ids);
            }
        }

        $this->totalQuestions = count($this->questions);

        if ($this->type !== CourseTestType::Practice && $this->attemptId) {
            $startedAt = CourseTestAttempt::query()->whereKey($this->attemptId)->value('started_at');
            if ($startedAt) {
                $this->examDeadlineTs = Carbon::parse($startedAt)
                    ->addMinutes(self::EXAM_TIME_LIMIT_MINUTES)
                    ->timestamp;
            }
        }

        if ($this->type === CourseTestType::Final && $council) {
            $this->passThresholdPercent = $this->resolvePassThreshold($course, $council);
        }

        if ($this->type !== CourseTestType::Practice) {
            $this->refreshExamTimer();
        }

        if ($user && $course) {
            $this->orderId = \App\Models\Order::query()
                ->where('user_id', $user->id)
                ->where('course_detail_id', $course->id)
                ->where('payment_status', \App\Enums\PaymentStatus::Completed)
                ->whereDate('start_date', '<=', now()->toDateString())
                ->whereDate('end_date', '>=', now()->toDateString())
                ->latest('id')
                ->value('id');
        }
    }

    /**
     * Called via wire:poll while the test is open so the countdown updates without client JS.
     */
    public function refreshExamTimer(): void
    {
        if ($this->type === CourseTestType::Practice || $this->submitted || $this->examDeadlineTs === null) {
            return;
        }

        $seconds = max(0, $this->examDeadlineTs - time());
        $this->examSecondsRemaining = $seconds;
        $this->examTimeExpired = $seconds === 0;
        $minutes = intdiv($seconds, 60);
        $secs = $seconds % 60;
        $this->examTimerDisplay = sprintf('%d:%02d', $minutes, $secs);
    }

    public function updatedResponses(): void
    {
        $this->submitError = null;
        $this->resetErrorBag('submit');
    }

    public function gotoQuestion(int $index): void
    {
        if ($index < 0 || $index >= count($this->questions)) {
            return;
        }
        $this->currentIndex = $index;
        $this->submitError = null;
        $this->resetErrorBag('submit');

        if ($this->attemptId) {
            CourseTestAttempt::query()->whereKey($this->attemptId)->update(['last_index' => $index]);
        }
    }

    public function nextQuestion(): void
    {
        $this->gotoQuestion($this->currentIndex + 1);
    }

    public function prevQuestion(): void
    {
        $this->gotoQuestion($this->currentIndex - 1);
    }

    public function submitTest(): void
    {
        if ($this->submitted || $this->fatalError || ! $this->attemptId) {
            return;
        }

        $this->normalizeResponseKeys();

        foreach ($this->questions as $q) {
            $id = (int) $q['id'];
            $v = $this->responses[$id] ?? null;
            if ($v === null || $v === '') {
                $this->submitError = 'Please answer all the questions .';
                $this->addError('submit', $this->submitError);

                return;
            }
        }
        $this->submitError = null;

        $user = auth()->user();
        abort_unless($user, 403);

        $attempt = CourseTestAttempt::query()
            ->where('user_id', $user->id)
            ->whereKey($this->attemptId)
            ->where('status', CourseTestAttempt::STATUS_IN_PROGRESS)
            ->first();

        if (! $attempt) {
            $this->addError('submit', 'This attempt is no longer active (it may have been submitted in another tab). Refresh the page to continue.');

            return;
        }

        $byId = CourseQuestion::query()->whereIn('id', $attempt->question_ids)->get()->keyBy('id');

        $correct = 0;
        $total = count($attempt->question_ids);
        $obtainedScore = 0;
        $maxScore = 0;
        $weights = $this->getLevelWeights();
        $levelStats = [
            1 => ['correct' => 0, 'total' => 0],
            2 => ['correct' => 0, 'total' => 0],
            3 => ['correct' => 0, 'total' => 0],
        ];

        DB::transaction(function () use ($attempt, $byId, $total, &$correct, &$obtainedScore, &$maxScore, $weights, &$levelStats): void {
            CourseTestAnswer::query()->where('course_test_attempt_id', $attempt->id)->delete();

            foreach ($attempt->question_ids as $i => $qid) {
                $q = $byId->get($qid);
                if (! $q) {
                    continue;
                }

                $levelStr = (string) ($q->question_level ?? 'Level 1');
                $levelNum = 1;
                if (str_contains($levelStr, '2')) {
                    $levelNum = 2;
                } elseif (str_contains($levelStr, '3')) {
                    $levelNum = 3;
                }
                $weight = $weights[$levelNum] ?? 1;
                $maxScore += $weight;
                $levelStats[$levelNum]['total']++;

                $selected = strtolower((string) ($this->responses[(int) $qid] ?? ''));
                $selected = substr($selected, 0, 1);
                $isCorrect = $this->answerMatches($q, $selected);
                if ($isCorrect) {
                    $correct++;
                    $obtainedScore += $weight;
                    $levelStats[$levelNum]['correct']++;
                }
                CourseTestAnswer::query()->create([
                    'course_test_attempt_id' => $attempt->id,
                    'course_question_id' => $q->id,
                    'display_index' => $i + 1,
                    'selected_choice' => $selected ?: null,
                    'is_correct' => $isCorrect,
                ]);
            }

            $score = $maxScore > 0 ? round(100 * $obtainedScore / $maxScore, 2) : 0.0;
            $passed = null;
            if ($this->type === CourseTestType::Final && $this->passThresholdPercent !== null) {
                $passed = $score >= $this->passThresholdPercent;
            }

            $attempt->update([
                'status' => CourseTestAttempt::STATUS_COMPLETED,
                'score_percent' => $score,
                'correct_count' => $correct,
                'total_questions' => $total,
                'passed' => $passed,
                'pass_threshold_percent' => $this->passThresholdPercent,
                'completed_at' => now(),
            ]);
        });

        $this->submitted = true;
        $this->correctCount = $correct;
        $this->obtainedScore = $obtainedScore;
        $this->maxScore = $maxScore;
        $this->scorePercent = $maxScore > 0 ? round(100 * $obtainedScore / $maxScore, 2) : 0.0;
        
        // Finalize levelStats with weights
        foreach ($levelStats as $lvl => $data) {
            $w = $weights[$lvl] ?? 1;
            $levelStats[$lvl]['weight'] = $w;
            $levelStats[$lvl]['score'] = $data['correct'] * $w;
            $levelStats[$lvl]['max'] = $data['total'] * $w;
        }
        $this->levelStats = $levelStats;

        $fresh = $attempt->fresh();
        $this->passed = $fresh->passed;
        $this->formattedDuration = $this->formatTestDuration($fresh->started_at, $fresh->completed_at);
        $this->rating = $fresh->rating;

        if ($this->type === CourseTestType::Final) {
            $this->finalAttemptCount = CourseTestAttempt::query()
                ->where('user_id', $user->id)
                ->where('course_detail_id', $this->courseId)
                ->where('test_type', CourseTestType::Final->value)
                ->where('status', CourseTestAttempt::STATUS_COMPLETED)
                ->count();
        }
    }

    public function setRating(int $value): void
    {
        if ($this->attemptId) {
            CourseTestAttempt::query()
                ->whereKey($this->attemptId)
                ->update(['rating' => $value]);
            $this->rating = $value;
        }
    }

    public function submitPracticeAnswer(int $questionId): void
    {
        if ($this->type !== CourseTestType::Practice) {
            return;
        }

        $response = $this->responses[$questionId] ?? null;
        if (! $response) {
            $this->submitError = 'Please select an answer.';

            return;
        }
        $this->submitError = null;

        $question = CourseQuestion::query()->find($questionId);
        if (! $question) {
            return;
        }

        $this->practiceAttempts[$questionId]++;
        $isCorrect = $this->answerMatches($question, strtolower($response));

        if ($isCorrect) {
            $this->practiceResults[$questionId] = 'correct';
            $this->practiceShowReasoning[$questionId] = true;
        } else {
            if ($this->practiceAttempts[$questionId] < 2) {
                $this->practiceResults[$questionId] = 'wrong_first';
                $this->practiceFirstWrongAnswer[$questionId] = $response; // Store the wrong choice
            } else {
                $this->practiceResults[$questionId] = 'wrong_second';
                $this->practiceShowReasoning[$questionId] = true;
            }
        }

        if ($this->attemptId) {
            $attempt = CourseTestAttempt::query()->find($this->attemptId);
            if ($attempt) {
                $displayIndex = array_search($questionId, $attempt->question_ids) + 1;
                CourseTestAnswer::query()->updateOrCreate(
                    [
                        'course_test_attempt_id' => $this->attemptId,
                        'course_question_id' => $questionId,
                    ],
                    [
                        'display_index' => $displayIndex,
                        'selected_choice' => $response,
                        'is_correct' => $isCorrect,
                        'attempts' => $this->practiceAttempts[$questionId],
                    ]
                );
            }
        }
    }

    public function render(): View
    {
        return view('livewire.frontend.course-test-taking', [
            'course' => CourseDetail::query()->findOrFail($this->courseId),
        ]);
    }

    /**
     * @param  list<int>  $ids
     */
    private function hydrateQuestionsPayload(array $ids): void
    {
        $rows = CourseQuestion::query()->whereIn('id', $ids)->get()->keyBy('id');
        $this->questions = [];
        $n = 1;
        foreach ($ids as $id) {
            $q = $rows->get($id);
            if (! $q) {
                continue;
            }
            $this->questions[] = [
                'id' => (int) $q->id,
                'num' => $n++,
                'text' => $q->question,
                'choices' => [
                    'a' => $q->choice_a,
                    'b' => $q->choice_b,
                    'c' => $q->choice_c,
                    'd' => $q->choice_d,
                ],
                'level' => $q->question_level,
            ];
        }
    }

    /**
     * @param  list<int>  $ids
     */
    private function initEmptyResponses(array $ids): void
    {
        foreach ($ids as $id) {
            $this->responses[(int) $id] = null;
        }
    }

    private function initPracticeStates(array $ids): void
    {
        $rows = CourseQuestion::query()->whereIn('id', $ids)->get()->keyBy('id');
        foreach ($ids as $id) {
            $qid = (int) $id;
            $this->practiceResults[$qid] = null;
            $this->practiceAttempts[$qid] = 0;
            $this->practiceShowReasoning[$qid] = false;
            
            $q = $rows->get($id);
            if ($q) {
                $this->practiceReasoning[$qid] = $q->reason;
                $this->practiceCorrectAnswers[$qid] = $this->extractExpectedLetter($q);
            }
            $this->practiceFirstWrongAnswer[$qid] = null;
        }
    }

    /**
     * Livewire / JSON round-trips may stringify array keys; normalize before submit.
     */
    private function normalizeResponseKeys(): void
    {
        $normalized = [];
        foreach ($this->responses as $key => $value) {
            $normalized[(int) $key] = $value;
        }
        $this->responses = $normalized;
    }

    private function hydrateResponsesFromAttempt(CourseTestAttempt $attempt): void
    {
        $this->initEmptyResponses($attempt->question_ids);
        $savedAnswers = CourseTestAnswer::query()
            ->where('course_test_attempt_id', $attempt->id)
            ->get();

        foreach ($savedAnswers as $ans) {
            $qid = (int) $ans->course_question_id;
            if ($ans->selected_choice !== null && $ans->selected_choice !== '') {
                $this->responses[$qid] = strtolower((string) $ans->selected_choice);
            }

            if ($this->type === CourseTestType::Practice) {
                $this->practiceAttempts[$qid] = (int) $ans->attempts;
                if ($ans->is_correct) {
                    $this->practiceResults[$qid] = 'correct';
                    $this->practiceShowReasoning[$qid] = true;
                } else {
                    if ($ans->attempts >= 2) {
                        $this->practiceResults[$qid] = 'wrong_second';
                        $this->practiceShowReasoning[$qid] = true;
                    } elseif ($ans->attempts === 1) {
                        $this->practiceResults[$qid] = 'wrong_first';
                        $this->practiceFirstWrongAnswer[$qid] = $ans->selected_choice;
                    }
                }
            }
        }
    }

    private function answerMatches(CourseQuestion $question, string $selectedOneLetter): bool
    {
        if (! $this->isGradableMultipleChoice($question)) {
            return false;
        }

        $raw = strtolower(trim((string) $question->answer));
        if ($raw === '') {
            return false;
        }

        $expectedLetter = $raw[0];
        if (! in_array($expectedLetter, ['a', 'b', 'c', 'd'], true)) {
            foreach (['a', 'b', 'c', 'd'] as $letter) {
                if (str_contains($raw, $letter)) {
                    $expectedLetter = $letter;

                    break;
                }
            }
        }

        return $expectedLetter === $selectedOneLetter && in_array($selectedOneLetter, ['a', 'b', 'c', 'd'], true);
    }

    private function extractExpectedLetter(CourseQuestion $question): ?string
    {
        $raw = strtolower(trim((string) $question->answer));
        if ($raw === '') {
            return null;
        }

        $expectedLetter = $raw[0];
        if (! in_array($expectedLetter, ['a', 'b', 'c', 'd'], true)) {
            foreach (['a', 'b', 'c', 'd'] as $letter) {
                if (str_contains($raw, $letter)) {
                    $expectedLetter = $letter;

                    break;
                }
            }
        }
        return in_array($expectedLetter, ['a', 'b', 'c', 'd'], true) ? $expectedLetter : null;
    }

    private function isGradableMultipleChoice(CourseQuestion $question): bool
    {
        if (! filled($question->choice_a) || ! filled($question->choice_b)) {
            return false;
        }

        $t = strtolower(trim((string) ($question->question_type ?? '')));

        return in_array($t, ['', 'mcq', 'short', 'objective', 'text'], true);
    }

    private function buildNoQuestionsMessage(CourseDetail $course, ?QuestionSplitUp $split, CourseTestQuestionSelector $selector): string
    {
        $title = (string) $course->couse_name;
        $totalAll = $selector->countAllRowsForCourse($course);
        $eligible = $selector->countEligibleMultipleChoiceForCourse($course);
        $code = filled($course->course_code ?? null) ? (string) $course->course_code : '—';

        $diag = "Module: “{$title}” (course record id {$course->id}). Admin counts for this record: {$totalAll} total question row(s), {$eligible} eligible active MCQ-style with choices. Course code: {$code}.";

        if ($this->type === CourseTestType::Practice) {
            return "No practice questions could be loaded.\n\n{$diag}\n\nIf total is 0, rows in Course Questions are linked to another module—filter by this exact module name or assign course id {$course->id}.";
        }

        if (! $split) {
            return "No question split was found for your state.\n\n{$diag}\n\nIn Super Admin, attach this course to a state council and save Mock / Pre / Final counts (L1–L3) for that council.";
        }

        $needed = $selector->totalQuestionsRequestedForType($split, $this->type);
        $label = $this->type->label();

        if ($needed === 0) {
            return "The blueprint for {$label} has 0 questions configured (all L1–L3 counts are zero for this test in the split).\n\n{$diag}\n\nAsk an admin to open the state council question split and set non-zero Mock / Pre / Final level counts.";
        }

        return "No suitable multiple-choice questions could be drawn for {$label}.\n\n{$diag}\n\nIf total question rows is 0, similar module names (for example Pediatric vs Psychiatric) are different courses—open Course Questions, filter by this exact module, and add or re-link rows. Otherwise check types (MCQ / short), levels (Level 1–3), and active status.";
    }

    private function formatTestDuration(?\DateTimeInterface $started, ?\DateTimeInterface $completed): string
    {
        if (! $started || ! $completed) {
            return '—';
        }

        $seconds = max(0, Carbon::parse($started)->diffInSeconds(Carbon::parse($completed)));
        $h = intdiv($seconds, 3600);
        $m = intdiv($seconds % 3600, 60);
        $s = $seconds % 60;

        if ($h > 0) {
            return sprintf('%d:%02d:%02d', $h, $m, $s);
        }

        return sprintf('%d:%02d', $m, $s);
    }

    /**
     * Only treat as the same session when the browser reports this same test URL (e.g. refresh).
     * Coming back from the module (or elsewhere) starts a new draw so questions are not stuck.
     */
    private function shouldResumeInProgressAttempt(?string $referer): bool
    {
        if ($this->type === CourseTestType::Practice) {
            return true;
        }

        if ($referer === null || $referer === '') {
            return true;
        }

        $refererPath = parse_url($referer, PHP_URL_PATH);
        if (! is_string($refererPath) || $refererPath === '') {
            return true;
        }

        $normalizedReferer = strtolower(trim($refererPath, '/'));
        $current = strtolower(trim(request()->path(), '/'));

        return $normalizedReferer === $current;
    }

    private function resolvePassThreshold(CourseDetail $course, \App\Models\StateCouncil $council): ?float
    {
        $attached = $course->stateCouncils()->where('state_councils.id', $council->id)->first();
        $raw = $attached?->pivot?->pass_percentage;
        if ($raw === null || $raw === '') {
            return null;
        }

        if (is_array($raw)) {
            $raw = $raw[0] ?? null;
        }
        if ($raw === null || $raw === '') {
            return null;
        }

        return (float) $raw;
    }

    private function getLevelWeights(): array
    {
        $scores = \App\Models\LevelScore::first();
        if (! $scores) {
            return [1 => 1, 2 => 2, 3 => 3];
        }

        return [
            1 => (int) $scores->level_1,
            2 => (int) $scores->level_2,
            3 => (int) $scores->level_3,
        ];
    }
}
