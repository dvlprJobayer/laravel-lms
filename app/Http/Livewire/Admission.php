<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Lead;
use App\Models\User;
use Livewire\Component;

class Admission extends Component
{
    public $search;
    public $leads = [];
    public $lead_id;
    public $course_id;
    public $selected_course;
    public function render()
    {
        $courses = Course::all();
        return view('livewire.admission', compact('courses'));
    }

    public function search()
    {
        $this->leads = Lead::where('name', 'like', '%' . $this->search . '%')
        ->orWhere('email', 'like', '%' . $this->search . '%')
        ->orWhere('phone', 'like', '%' . $this->search . '%')
        ->get();
    }

    public function courseSelect ()
    {
        $this->selected_course = Course::find($this->course_id);
    }

    public function admit () {
        $lead = Lead::find($this->lead_id);

        $user = User::create([
            'name' => $lead->name,
            'email' => $lead->email,
            'password' => bcrypt(123456),
        ]);

        $lead->delete();

        $invoice = Invoice::create([
            'user_id' => $user->id,
            'due_date' => now()->addDays(7),
        ]);

        InvoiceItem::create([
            'name' => 'Course: '. $this->selected_course->name,
            'price' => $this->selected_course->price,
            'quantity' => 1,
            'invoice_id' => $invoice->id,
        ]);

        $this->search = null;
        $this->leads = [];
        $this->lead_id = null;
        $this->course_id = null;
        $this->selected_course = null;

        flash()->addSuccess('Admission successful!');
    }
}
