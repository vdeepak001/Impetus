<?php

namespace App\Livewire\SuperAdmin\StateCouncil;

use App\Models\CourseDetail;
use App\Models\StateCouncil;
use Livewire\Component;

class CourseManager extends Component
{
    public ?StateCouncil $stateCouncil = null;
    public $selectedCourses = [];
    public $allCourses = [];
    public $newCourseId = '';
    public $savedCourseId = null;

    public function mount(?StateCouncil $stateCouncil = null)
    {
        $this->stateCouncil = $stateCouncil;
        $this->allCourses = CourseDetail::orderBy('couse_name')->get();

        if ($stateCouncil && $stateCouncil->exists) {
            foreach ($stateCouncil->courseDetails as $course) {
                $this->selectedCourses[$course->id] = [
                    'id' => $course->id,
                    'name' => $course->couse_name,
                    'code' => $course->course_code,
                    'pass_percentage' => $course->pivot->pass_percentage[0] ?? '',
                    'mrp' => $course->pivot->mrp[0] ?? '',
                    'offer_price' => $course->pivot->offer_price[0] ?? '',
                    'points' => $course->pivot->points[0] ?? '',
                    'valid_days' => $course->pivot->valid_days[0] ?? '',
                ];
            }
        }
    }

    public function addCourse()
    {
        if (!$this->newCourseId || isset($this->selectedCourses[$this->newCourseId])) {
            return;
        }

        $course = CourseDetail::find($this->newCourseId);
        if ($course) {
            $this->selectedCourses[$this->newCourseId] = [
                'id' => $course->id,
                'name' => $course->couse_name,
                'code' => $course->course_code,
                'pass_percentage' => '',
                'mrp' => '',
                'offer_price' => '',
                'points' => '',
                'valid_days' => '',
            ];
        }

        $this->newCourseId = '';
    }

    public function removeCourse($courseId)
    {
        if ($this->stateCouncil && $this->stateCouncil->exists) {
            $this->stateCouncil->courseDetails()->detach($courseId);
        }
        unset($this->selectedCourses[$courseId]);
    }

    public function saveCourse($courseId)
    {
        if (!$this->stateCouncil || !$this->stateCouncil->exists || !isset($this->selectedCourses[$courseId])) {
            return;
        }

        $settings = $this->selectedCourses[$courseId];
        
        // Prepare data for pivot update (wrap scalar into a single-element array for JSON storage)
        $pivotData = [
            'pass_percentage' => $this->parseSettingsArray($settings['pass_percentage']),
            'mrp' => $this->parseSettingsArray($settings['mrp']),
            'offer_price' => $this->parseSettingsArray($settings['offer_price']),
            'points' => $this->parseSettingsArray($settings['points']),
            'valid_days' => $this->parseSettingsArray($settings['valid_days'], 'intval'),
        ];

        $this->stateCouncil->courseDetails()->updateExistingPivot($courseId, $pivotData);
        
        $this->savedCourseId = $courseId;
        $this->dispatch('course-saved');
    }

    private function parseSettingsArray(mixed $value, ?string $cast = null): array
    {
        // If it's already an array (for the test questions), handle each element
        if (is_array($value)) {
            $result = array_map(fn($v) => ($v === '' || $v === null) ? null : $v, $value);
            if ($cast === 'intval') {
                $result = array_map(fn($v) => $v === null ? null : (int)$v, $result);
            }
            return $result;
        }

        // For other single scalar fields, wrap it in a single-element array
        if ($value === '' || $value === null) {
            return [null];
        }

        $result = $cast === 'intval' ? (int) $value : $value;
        return [$result];
    }

    public function render()
    {
        return view('livewire.super-admin.state-council.course-manager');
    }
}
