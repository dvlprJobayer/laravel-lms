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
            <td class="border px-4 py-2 text-center">{{ $invoice->calculation()['total'] }}</td>
            <td class="border px-4 py-2 text-center">{{ $invoice->calculation()['paid'] }}</td>
            <td class="border px-4 py-2 text-center">{{ $invoice->calculation()['due'] }}</td>
            <td class="border px-4 py-2 text-center">
                <div class="flex items-center justify-around">
                    <a href="">
                        @include('components.icons.edit')
                    </a>
                    <a href="{{ route('invoice-show', $invoice->id) }}">
                        @include('components.icons.view')
                    </a>

                    <form onsubmit="return confirm('Are you Sure?')"
                        wire:submit.prevent="invoiceDelete({{ $invoice->id }})">
                        <button type="submit">
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