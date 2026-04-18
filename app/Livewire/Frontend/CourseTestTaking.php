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
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CourseTestTaking extends Component
{
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

    public int $totalQuestions = 0;

    public ?string $fatalError = null;

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

        $selector = app(CourseTestQuestionSelector::class);
        $ids = $selector->selectQuestionIds($course, $split, $this->type);

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

        if ($inProgress) {
            $this->attemptId = $inProgress->id;
            $ids = $inProgress->question_ids;
            $this->hydrateQuestionsPayload($ids);
            $this->hydrateResponsesFromAttempt($inProgress);
        } else {
            $attempt = CourseTestAttempt::query()->create([
                'user_id' => $user->id,
                'course_detail_id' => $course->id,
                'state_council_id' => $council?->id,
                'test_type' => $this->type,
                'status' => CourseTestAttempt::STATUS_IN_PROGRESS,
                'question_ids' => $ids,
                'correct_count' => 0,
                'total_questions' => count($ids),
                'started_at' => now(),
            ]);
            $this->attemptId = $attempt->id;
            $this->hydrateQuestionsPayload($ids);
            $this->initEmptyResponses($ids);
        }

        $this->totalQuestions = count($this->questions);

        if ($this->type === CourseTestType::Final && $council) {
            $this->passThresholdPercent = $this->resolvePassThreshold($course, $council);
        }
    }

    public function gotoQuestion(int $index): void
    {
        if ($index < 0 || $index >= count($this->questions)) {
            return;
        }
        $this->currentIndex = $index;
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
                $this->addError('submit', 'Please answer every question before submitting.');

                return;
            }
        }

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

        DB::transaction(function () use ($attempt, $byId, $total, &$correct): void {
            CourseTestAnswer::query()->where('course_test_attempt_id', $attempt->id)->delete();

            foreach ($attempt->question_ids as $i => $qid) {
                $q = $byId->get($qid);
                if (! $q) {
                    continue;
                }
                $selected = strtolower((string) ($this->responses[(int) $qid] ?? ''));
                $selected = substr($selected, 0, 1);
                $isCorrect = $this->answerMatches($q, $selected);
                if ($isCorrect) {
                    $correct++;
                }
                CourseTestAnswer::query()->create([
                    'course_test_attempt_id' => $attempt->id,
                    'course_question_id' => $q->id,
                    'display_index' => $i + 1,
                    'selected_choice' => $selected ?: null,
                    'is_correct' => $isCorrect,
                ]);
            }

            $score = $total > 0 ? round(100 * $correct / $total, 2) : 0.0;
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
        $this->scorePercent = $total > 0 ? round(100 * $correct / $total, 2) : 0.0;
        $this->passed = $attempt->fresh()->passed;
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
        $saved = CourseTestAnswer::query()
            ->where('course_test_attempt_id', $attempt->id)
            ->pluck('selected_choice', 'course_question_id');
        foreach ($saved as $qid => $letter) {
            if ($letter !== null && $letter !== '') {
                $this->responses[(int) $qid] = strtolower((string) $letter);
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
}
