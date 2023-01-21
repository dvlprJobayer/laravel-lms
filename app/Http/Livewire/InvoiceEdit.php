<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use Livewire\Component;

class InvoiceEdit extends Component
{
    public $invoice_id;
    public $name;
    public $price;
    public $quantity;
    public $isOpen = false;
    public function render()
    {
        $invoice = Invoice::findOrFail($this->invoice_id);
        return view('livewire.invoice-edit', compact('invoice'));
    }

    public function formVisible()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function addItem () {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        InvoiceItem::create([
            'invoice_id' => $this->invoice_id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ]);

        Payment::create([
            'invoice_id' => $this->invoice_id,
            'amount' => $this->price * $this->quantity,
        ]);

        flash()->addSuccess('Item added successfully');

        $this->reset('name', 'price', 'quantity');
        $this->formVisible();
    }
}
