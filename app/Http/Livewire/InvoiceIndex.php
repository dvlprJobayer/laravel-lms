<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceIndex extends Component
{
    use WithPagination;
    public function render()
    {
        $invoices = Invoice::paginate(50);
        return view('livewire.invoice-index', compact('invoices'));
    }

    public function invoiceDelete ($id) {
        $invoice = Invoice::find($id);
        $invoice->delete();
        flash()->addSuccess('Invoice deleted successfully');
    }
}