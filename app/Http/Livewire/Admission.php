<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Lead;
use App\Models\Payment;
use App\Models\User;
use Livewire\Component;

class Admission extends Component
{
    public $name;
    public $email;
    public $password;
    public $user_id;
    public $search;
    public $not_found = false;
    public $leads = [];
    public $lead_id;
    public $course_id;
    public $payment;
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
        if($this->leads->count() == 0) {
            $this->not_found = true;
        } else {
            $this->not_found = false;
        }
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

        $this->selected_course->students()->attach($user->id);

        if(!empty($this->payment)) {
            Payment::create([
                'amount' => $this->payment,
                'invoice_id' => $invoice->id,
                'transaction_id' => '123456789',
            ]);
        }

        $this->search = null;
        $this->leads = [];
        $this->lead_id = null;
        $this->course_id = null;
        $this->selected_course = null;
        $this->payment = null;

        flash()->addSuccess('Admission successful!');
    }

    public function addStudent() {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->user_id = $user->id;
    }

    public function studentAdmit () {
        $invoice = Invoice::create([
            'user_id' => $this->user_id,
            'due_date' => now()->addDays(7),
        ]);

        InvoiceItem::create([
            'name' => 'Course: '. $this->selected_course->name,
            'price' => $this->selected_course->price,
            'quantity' => 1,
            'invoice_id' => $invoice->id,
        ]);

        $this->selected_course->students()->attach($this->user_id);

        if(!empty($this->payment)) {
            Payment::create([
                'amount' => $this->payment,
                'invoice_id' => $invoice->id,
                'transaction_id' => '123456789',
            ]);
        }

        $this->search = null;
        $this->leads = [];
        $this->lead_id = null;
        $this->course_id = null;
        $this->selected_course = null;
        $this->payment = null;
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->not_found = false;

        flash()->addSuccess('Admission successful!');
    }
}
