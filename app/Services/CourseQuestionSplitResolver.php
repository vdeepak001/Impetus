<?php

namespace App\Services;

use App\Models\CourseDetail;
use App\Models\QuestionSplitUp;
use App\Models\StateCouncil;

class CourseQuestionSplitResolver
{
    /**
     * Resolves the difficulty split for a module test.
     * Falls back to any split attached to a state council linked to this course when
     * council-specific lookup fails (e.g. user profile state mismatch, order missing state_council_id).
     */
    public function resolve(?StateCouncil $council, CourseDetail $course): ?QuestionSplitUp
    {
        if ($council) {
            $split = QuestionSplitUp::query()->where('state_council_id', $council->id)->first();
            if ($split) {
                return $split;
            }
        }

        $split = QuestionSplitUp::query()->whereNull('state_council_id')->first();
        if ($split) {
            return $split;
        }

        $councilIds = $course->stateCouncils()->pluck('state_councils.id');
        if ($councilIds->isEmpty()) {
            return null;
        }

        return QuestionSplitUp::query()
            ->whereIn('state_council_id', $councilIds)
            ->first();
    }
}
