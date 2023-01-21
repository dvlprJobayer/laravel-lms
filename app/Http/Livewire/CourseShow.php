<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Curriculum;
use Livewire\Component;

class CourseShow extends Component
{
    public $course_slug;
    public function render()
    {
        $course = Course::where('slug',$this->course_slug)->first();
        if (!$course)
            abort(404);
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
