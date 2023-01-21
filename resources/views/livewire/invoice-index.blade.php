<div>
    <table class="w-full">
        <tr>
            <th class="border px-4 py-2 text-left">ID</th>
            <th class="border px-4 py-2 text-left">User</th>
            <th class="border px-4 py-2 text-left">Due Date</th>
            <th class="border px-4 py-2 text-left">Registered</th>
            <th class="border px-4 py-2">Amount</th>
            <th class="border px-4 py-2">Paid</th>
            <th class="border px-4 py-2">Due</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
        @foreach ($invoices as $invoice)
        <tr>
            <td class="border px-4 py-2">{{ $invoice->id }}</td>
            <td class="border px-4 py-2">{{ $invoice->user->name }}</td>
            <td class="border px-4 py-2">{{ date('F j Y', strtotime($invoice->due_date)) }}</td>
            <td class="border px-4 py-2">{{ date('F j Y', strtotime($invoice->created_at)) }}</td>
            <td class="border px-4 py-2 text-center">${{ number_format($invoice->calculation()['total'], 2) }}</td>
            <td class="border px-4 py-2 text-center">${{ number_format($invoice->calculation()['paid'], 2) }}</td>
            <td class="border px-4 py-2 text-center">${{ number_format($invoice->calculation()['due'], 2) }}</td>
            <td class="border px-4 py-2 text-center">
                <div class="flex items-center justify-around">
                    <a href="{{ route('invoice.edit', $invoice->id) }}">
                        @include('components.icons.edit')
                    </a>
                    <a href="{{ route('invoice.show', $invoice->id) }}">
                        @include('components.icons.view')
                    </a>

                    <form wire:submit.prevent="invoiceDelete({{ $invoice->id }})">
                        <button onclick="return confirm('Are you Sure want to delete?')">
                            @include('components.icons.delete')
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="mt-4">
        {{ $invoices->links() }}
    </div>
</div>