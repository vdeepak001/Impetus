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

    public function mount(?StateCouncil $stateCouncil = null)
    {
        $this->stateCouncil = $stateCouncil;
        $this->allCourses = CourseDetail::orderBy('couse_name')->get();

        // Check for old input first (on validation failure)
        $oldCourses = old('courses');
        if (is_array($oldCourses)) {
            foreach ($oldCourses as $id => $settings) {
                $course = CourseDetail::find($id);
                if ($course) {
                    $this->selectedCourses[$id] = [
                        'id' => $id,
                        'name' => $course->couse_name,
                        'code' => $course->course_code,
                        'pass_percentage' => is_array($settings['pass_percentage']) ? ($settings['pass_percentage'][0] ?? '') : $settings['pass_percentage'],
                        'mrp' => is_array($settings['mrp']) ? ($settings['mrp'][0] ?? '') : $settings['mrp'],
                        'offer_price' => is_array($settings['offer_price']) ? ($settings['offer_price'][0] ?? '') : $settings['offer_price'],
                        'points' => is_array($settings['points']) ? ($settings['points'][0] ?? '') : $settings['points'],
                        'valid_days' => is_array($settings['valid_days']) ? ($settings['valid_days'][0] ?? '') : $settings['valid_days'],
                    ];
                }
            }
            return;
        }

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

    public function render()
    {
        return view('livewire.super-admin.state-council.course-manager');
    }
}

