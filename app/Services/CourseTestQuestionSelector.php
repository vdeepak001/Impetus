<?php

namespace App\Services;

use App\Enums\CourseTestType;
use App\Models\CourseDetail;
use App\Models\CourseQuestion;
use App\Models\QuestionSplitUp;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CourseTestQuestionSelector
{
    private const LEVEL_LABELS = ['Level 1', 'Level 2', 'Level 3'];

    /**
     * Aliases seen in legacy data or imports (admin UI uses "Level 1", …).
     *
     * @return list<string>
     */
    private function levelAliases(int $levelIndex): array
    {
        return match ($levelIndex) {
            0 => ['Level 1', 'L1', 'LEVEL 1', 'level 1', 'Level1', '1', 'I'],
            1 => ['Level 2', 'L2', 'LEVEL 2', 'level 2', 'Level2', '2', 'II'],
            2 => ['Level 3', 'L3', 'LEVEL 3', 'level 3', 'Level3', '3', 'III'],
            default => [],
        };
    }

    /**
     * Normalized level tokens for SQL comparison (trim + lowercase).
     *
     * @return list<string>
     */
    private function normalizedLevelTokens(int $levelIndex): array
    {
        return array_values(array_unique(array_map(
            fn (string $a) => mb_strtolower(trim($a)),
            $this->levelAliases($levelIndex)
        )));
    }

    /**
     * Types that use A–D (or the same) auto-marking. Includes legacy/import values.
     * "text" is only included when the row has choices (mis-tagged MCQs).
     */
    private function applyMcqTypeConstraint(Builder $q): void
    {
        $q->where(function (Builder $inner) {
            $inner->whereNull('question_type')
                ->orWhereRaw("TRIM(COALESCE(question_type, '')) = ''")
                ->orWhereRaw('LOWER(TRIM(question_type)) IN (?, ?, ?)', ['mcq', 'short', 'objective'])
                ->orWhere(function (Builder $textWithChoices) {
                    $textWithChoices
                        ->whereRaw('LOWER(TRIM(COALESCE(question_type, ?))) = ?', ['', 'text'])
                        ->whereNotNull('choice_a')
                        ->whereNotNull('choice_b');
                });
        });
    }

    private function applyActiveConstraint(Builder $q): void
    {
        $q->where(function (Builder $inner) {
            $inner->whereNull('active_status')
                ->orWhere('active_status', true)
                ->orWhere('active_status', 1)
                ->orWhere('active_status', '1');
        });
    }

    /**
     * Standard pool: this course, MCQ-like, active or usable status.
     */
    private function baseQuestionQuery(CourseDetail $course): Builder
    {
        return CourseQuestion::query()
            ->where('course_id', $course->id)
            ->where(fn (Builder $q) => $this->applyMcqTypeConstraint($q))
            ->where(fn (Builder $q) => $this->applyActiveConstraint($q));
    }

    /**
     * Last resort: MCQ-like only — ignores active flag (badly imported rows).
     */
    private function lenientQuestionQuery(CourseDetail $course): Builder
    {
        return CourseQuestion::query()
            ->where('course_id', $course->id)
            ->where(fn (Builder $q) => $this->applyMcqTypeConstraint($q));
    }

    /**
     * Narrow to questions whose level matches one of the difficulty buckets.
     */
    private function scopeLevelBucket(Builder $query, int $levelIndex): Builder
    {
        $tokens = $this->normalizedLevelTokens($levelIndex);

        return $query->where(function (Builder $q) use ($tokens) {
            foreach ($tokens as $token) {
                $q->orWhereRaw('LOWER(TRIM(COALESCE(question_level, ?))) = ?', ['', $token]);
            }
        });
    }

    private function totalQuestionsRequested(QuestionSplitUp $split, string $prefix): int
    {
        $n = 0;
        foreach ([1, 2, 3] as $levelNum) {
            $col = "{$prefix}_l{$levelNum}";
            $n += max(0, (int) ($split->{$col} ?? 0));
        }

        return $n;
    }

    /**
     * Sum of L1–L3 slots in the split for Mock / Pre / Final (0 for Practice).
     */
    public function totalQuestionsRequestedForType(QuestionSplitUp $split, CourseTestType $type): int
    {
        $prefix = match ($type) {
            CourseTestType::Mock => 'mock',
            CourseTestType::Pre => 'pre',
            CourseTestType::Final => 'final',
            default => null,
        };

        if ($prefix === null) {
            return 0;
        }

        return $this->totalQuestionsRequested($split, $prefix);
    }

    /** All course_questions rows for this module (any type / status). */
    public function countAllRowsForCourse(CourseDetail $course): int
    {
        return CourseQuestion::query()->where('course_id', $course->id)->count();
    }

    /** Active MCQ-style rows with A/B choices (same pool as stratified selection). */
    public function countEligibleMultipleChoiceForCourse(CourseDetail $course): int
    {
        return (int) $this->baseQuestionQuery($course)->count();
    }

    /**
     * @return list<int>
     */
    private function pickRandomIds(Builder $source, int $limit): array
    {
        if ($limit <= 0) {
            return [];
        }

        return $source
            ->inRandomOrder()
            ->limit($limit)
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();
    }

    /**
     * Ordered list of course_questions.id values for the attempt.
     *
     * @return list<int>
     */
    public function selectQuestionIds(CourseDetail $course, ?QuestionSplitUp $split, CourseTestType $type): array
    {
        if ($type === CourseTestType::Practice) {
            return $this->practiceQuestionIds($course);
        }

        if (! $split) {
            return [];
        }

        $prefix = match ($type) {
            CourseTestType::Mock => 'mock',
            CourseTestType::Pre => 'pre',
            CourseTestType::Final => 'final',
            default => 'mock',
        };

        $totalNeeded = $this->totalQuestionsRequested($split, $prefix);
        if ($totalNeeded === 0) {
            return [];
        }

        $ids = [];

        foreach ([1, 2, 3] as $i => $levelNum) {
            $col = "{$prefix}_l{$levelNum}";
            $count = (int) ($split->{$col} ?? 0);
            if ($count <= 0) {
                continue;
            }
            $query = $this->scopeLevelBucket($this->baseQuestionQuery($course), $i);
            foreach ($this->pickRandomIds($query, $count) as $id) {
                $ids[] = $id;
            }
        }

        if ($ids !== []) {
            return $ids;
        }

        $flat = $this->pickRandomIds($this->baseQuestionQuery($course), $totalNeeded);
        if ($flat !== []) {
            return $flat;
        }

        $flat = $this->pickRandomIds($this->lenientQuestionQuery($course), $totalNeeded);
        if ($flat !== []) {
            return $flat;
        }

        if (filled($course->course_code)) {
            $linked = CourseQuestion::query()
                ->whereHas('course', function (Builder $cq) use ($course) {
                    $cq->where('course_code', $course->course_code);
                })
                ->where(fn (Builder $q) => $this->applyMcqTypeConstraint($q))
                ->where(fn (Builder $q) => $this->applyActiveConstraint($q));
            $flat = $this->pickRandomIds($linked, $totalNeeded);
            if ($flat !== []) {
                return $flat;
            }

            $linkedLenient = CourseQuestion::query()
                ->whereHas('course', function (Builder $cq) use ($course) {
                    $cq->where('course_code', $course->course_code);
                })
                ->where(fn (Builder $q) => $this->applyMcqTypeConstraint($q));

            return $this->pickRandomIds($linkedLenient, $totalNeeded);
        }

        return [];
    }

    /**
     * Practice: up to 30 eligible MCQs drawn at random from the full pool (same random draw style as mock / pre / final when using the flat pool).
     *
     * @return list<int>
     */
    private function practiceQuestionIds(CourseDetail $course): array
    {
        $cap = 30;
        $base = $this->baseQuestionQuery($course);
        $count = (int) (clone $base)->count();
        $limit = min($cap, max(0, $count));

        if ($limit > 0) {
            $ids = $this->pickRandomIds($base, $limit);
            if ($ids !== []) {
                return $ids;
            }
        }

        return $this->pickRandomIds($this->lenientQuestionQuery($course), $cap);
    }

    public function levelLabelForQuestion(CourseQuestion $question): string
    {
        return $question->question_level ?: 'Other';
    }

    /**
     * @param  Collection<int, CourseQuestion>  $questions
     * @return list<array{level:string,questions:Collection<int, CourseQuestion>}>
     */
    public function groupByLevel(Collection $questions): array
    {
        $ordered = [];
        foreach (self::LEVEL_LABELS as $label) {
            $group = $questions->filter(fn (CourseQuestion $q) => $q->question_level === $label)->values();
            if ($group->isNotEmpty()) {
                $ordered[] = ['level' => $label, 'questions' => $group];
            }
        }

        $other = $questions->filter(fn (CourseQuestion $q) => ! in_array($q->question_level, self::LEVEL_LABELS, true))->values();
        if ($other->isNotEmpty()) {
            $ordered[] = ['level' => 'Other', 'questions' => $other];
        }

        return $ordered;
    }
}
