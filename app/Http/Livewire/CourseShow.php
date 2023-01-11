<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Curriculum;
use Livewire\Component;

class CourseShow extends Component
{
    public $course_id;
    public function render()
    {
        $course = Course::findOrFail($this->course_id);
        return view('livewire.course-show', [
            'course' => $course,
            'curriculums' => $course->curriculums
        ]);
    }

    public function deleteClass($id)
    {
        $curriculum = Curriculum::find($id);
        $curriculum->delete();
        flash()->addSuccess($curriculum->name . ' Deleted Successfully');
    }
}
