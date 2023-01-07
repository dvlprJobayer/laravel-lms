<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use App\Models\Note;
use Livewire\Component;

class LeadEdit extends Component
{

    public $lead_id;
    public $name;
    public $phone;
    public $email;
    public $note_title;
    public $note_description;

    public function mount()
    {
        $lead = Lead::findOrFail($this->lead_id);
        $this->lead_id = $lead->id;
        $this->name = $lead->name;
        $this->phone = $lead->phone;
        $this->email = $lead->email;
    }
    public function render()
    {
        $lead = Lead::findOrFail($this->lead_id);
        return view('livewire.lead-edit', [
            'notes' => $lead->notes,
        ]);
    }

    public function updateForm () {

        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email',
        ]);

        $lead = Lead::findOrFail($this->lead_id);
        $lead->name = $this->name;
        $lead->phone = $this->phone;
        $lead->email = $this->email;
        $lead->save();
        flash()->addSuccess('Lead updated successfully');
    }

    public function addNote () {

        $this->validate([
            'note_title' => 'required',
            'note_description' => 'required',
        ]);

        $note = new Note();
        $note->title = $this->note_title;
        $note->description = $this->note_description;
        $note->lead_id = $this->lead_id;
        $note->save();

        $this->note_title = '';
        $this->note_description = '';

        flash()->addSuccess('Note added successfully');
    }
}
