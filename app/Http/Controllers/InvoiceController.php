<?php

namespace App\Http\Controllers;

use App\Models\Invoice as ModelsInvoice;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Party;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.index');
    }

    public function show ($id)
    {
        $myInvoice = ModelsInvoice::findOrFail($id);

        $client = new Party([
            'name'          => 'Jobayer Ahammed',
            'phone'         => '(520) 318-9486',
            'custom_fields' => [
                'email'       => 'jobayer@ahammed.com',
                'business id' => '365#GG',
            ],
        ]);


        $customer = new Buyer([
            'name'          => $myInvoice->user->name,
            'custom_fields' => [
                'email' => $myInvoice->user->email,
            ],
        ]);

        $items = [];
        foreach ($myInvoice->invoiceItems as $item) {
            $items[] = (new InvoiceItem())->title($item->name)->pricePerUnit($item->price)->quantity($item->quantity);
        }

        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($client)
            ->currencySymbol('$')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->dateFormat('m/d/Y')
            ->currencyCode('USD')
            ->payUntilDays(14)
            ->addItems($items);

        return $invoice->stream();
    }
}
