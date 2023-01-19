<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Livewire\Component;

class CurriculumShow extends Component
{
    public $curriculum_id;

    public $note_title;
    public $note_body;
    public function render()
    {
        $curriculum = \App\Models\Curriculum::findOrFail($this->curriculum_id);
        return view('livewire.curriculum-show', [
            'curriculum' => $curriculum,
            'notes' => $curriculum->notes,
        ]);
    }

    public function addNote() {
        $this->validate([
            'note_title' => 'required',
            'note_body' => 'required',
        ]);

        $curriculum = \App\Models\Curriculum::findOrFail($this->curriculum_id);
        $curriculum->notes()->create([
            'title' => $this->note_title,
            'description' => $this->note_body,
            'curriculum_id' => $this->curriculum_id,
        ]);

        $this->reset('note_title', 'note_body');
        flash()->addSuccess('Note added successfully');
    }

    public function deleteNote($id) {
        $note = \App\Models\Note::findOrFail($id);
        $note->delete();
        flash()->addSuccess('Note deleted successfully');
    }

    public function attendance($student_id)
    {
        Attendance::create([
            'user_id' => $student_id,
            'curriculum_id' => $this->curriculum_id,
        ]);

        flash()->addSuccess('Attendance marked successfully');
    }
}
