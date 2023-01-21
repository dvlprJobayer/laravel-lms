<div>
    <div class="space-y-1 mb-4">
        <h2 class="text-lg font-semibold">Invoice To: {{ $invoice->user->name }}</h2>
        <h3 class="font-semibold">Email: {{ $invoice->user->email }}</h3>
    </div>

    <table class="w-full">
        <tr>
            <th class="border px-4 py-2 text-left">Name</th>
            <th class="border px-4 py-2 text-left">Price</th>
            <th class="border px-4 py-2">Quantity</th>
            <th class="border px-4 py-2 text-right">Total</th>
        </tr>
        @foreach ($invoice->invoiceItems as $invoiceItem)
        <tr>
            <td class="border px-4 py-2">{{ $invoiceItem->name }}</td>
            <td class="border px-4 py-2">${{ number_format($invoiceItem->price, 2) }}</td>
            <td class="border px-4 py-2 text-center">{{ $invoiceItem->quantity }}</td>
            <td class="border px-4 py-2 text-right">${{ number_format($invoiceItem->price * $invoiceItem->quantity, 2)
                }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td class="border px-4 py-2 text-right font-semibold" colspan="3">SubTotal</td>
            <td class="border px-4 py-2 text-right font-semibold">${{ number_format($invoice->calculation()['total'], 2)
                }}</td>
        </tr>
        <tr>
            <td class="border px-4 py-2 text-right font-semibold" colspan="3">Paid</td>
            <td class="border px-4 py-2 text-right font-semibold">- ${{ number_format($invoice->calculation()['paid'],
                2)
                }}</td>
        </tr>
        <tr>
            <td class="border px-4 py-2 text-right font-semibold" colspan="3">Due</td>
            <td class="border px-4 py-2 text-right font-semibold">${{ number_format($invoice->calculation()['due'], 2)
                }}</td>
        </tr>
    </table>

    @if ($isOpen)
    <form wire:submit.prevent="addItem">
        <div class="flex items-center gap-x-4 mt-4">
            <div class="flex-1">
                @include('components.form-field', [
                'label' => 'Item Name',
                'type' => 'text',
                'name' => 'name',
                'placeholder' => 'Enter Item Name',
                'required' => 'required',
                'class' => 'w-full',
                ])
            </div>
            <div>
                @include('components.form-field', [
                'label' => 'Price',
                'type' => 'number',
                'name' => 'price',
                'placeholder' => 'Enter price',
                'required' => 'required',
                'class' => 'w-full',
                ])
            </div>
            <div>
                @include('components.form-field', [
                'label' => 'Quantity',
                'type' => 'number',
                'name' => 'quantity',
                'placeholder' => 'Enter quantity',
                'required' => 'required',
                'class' => 'w-full',
                ])
            </div>
        </div>

        @include('components.loading')
        <div class="space-x-4">
            <button wire:loading.delay.long.remove class="lms-btn mt-5" type="submit">Add Item</button>
            <button wire:click="formVisible" type="button" class="underline font-semibold">Cancel</button>
        </div>
    </form>
    @else
    <button wire:click="formVisible" class="text-lg underline font-semibold mt-4">Add Item</button>
    @endif

    <h3 class="text-lg font-bold mt-2 mb-1">Payments</h3>
    <ul class="list-disc ml-5">
        @foreach ($invoice->payments as $payment)
        <li>{{ date('F j, Y - g:i:a', strtotime($payment->created_at)) }} | <span class="font-bold">${{
                number_format($payment->amount, 2) }}</span> | Transaction ID: {{ $payment->transaction_id }} --
            <button wire:click="refund({{ $payment->id }})"
                class="text-sm bg-purple-500 px-2 py-1 rounded-md text-white">Refund</button>
        </li>
        @endforeach
    </ul>
</div>