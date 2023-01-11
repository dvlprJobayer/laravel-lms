<?php

namespace App\Http\Livewire;

use App\Models\Curriculum;
use Livewire\Component;

class CurriculumEdit extends Component
{
    public $curriculum_id;
    public $name;
    public $date;
    public $time;

    public function mount()
    {
        $curriculum = Curriculum::findOrFail($this->curriculum_id);
        $this->name = $curriculum->name;
        $this->date = date('Y-m-d', strtotime($curriculum->class_date));
        $this->time = $curriculum->class_time;
    }
    public function render()
    {
        return view('livewire.curriculum-edit');
    }

    public function updateCurriculum () {
        $this->validate([
            'name' => 'required|min:3',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $curriculum = Curriculum::findOrFail($this->curriculum_id);
        $curriculum->name = $this->name;
        $curriculum->class_date = $this->date;
        $curriculum->class_time = $this->time;
        $curriculum->save();
        flash()->addSuccess('Curriculum updated successfully');
        return redirect()->route('course.show', $curriculum->course->id);
    }
}
