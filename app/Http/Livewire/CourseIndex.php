<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;

class CourseIndex extends Component
{
    public function render()
    {
        $courses = Course::orderBy('created_at', 'desc')->get();
        return view('livewire.course-index', compact('courses'));
    }

    public function deleteCourse($id) {
        $course = Course::find($id);
        $course->delete();
        flash()->addSuccess('Course Deleted Successfully');
    }
}
