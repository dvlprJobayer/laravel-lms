<?php

namespace App\Http\Livewire;

use App\Models\Lead;
use Livewire\Component;

class LeadIndex extends Component
{
    public function render()
    {
        $leads = Lead::paginate(10);
        return view('livewire.lead-index', compact('leads'));
    }

    public function lead_delete($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();
        flash()->addSuccess('Lead deleted successfully');
    }
}