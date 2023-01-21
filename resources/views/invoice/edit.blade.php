<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Invoice') }}
            </h2>

            <a class="lms-btn" href="{{ route('invoice.index') }}">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <livewire:invoice-edit :invoice_id="$invoice->id" />

                    @if($invoice->calculation()['due'] > 0)
                    <h2 class="text-lg font-semibold mt-4">Payment Here</h2>
                    <div class="space-x-2 mt-2 mb-3">
                        <button id="card" class="bg-black text-white font-semibold p-2 rounded-lg">Pay by Card</button>
                        <button id="cash" class="underline font-semibold">Pay by Cash</button>
                    </div>
                    <form id="stripeForm" method="POST" action="{{ route('stripe') }}">
                        @csrf
                        <div class="flex items-center gap-x-4">
                            <div class="flex-1">
                                <input type="number" value="4000056655665556" name="card_number"
                                    class="lms-input w-full" placeholder="Enter Card Number">
                                @error('card_number')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <input value="08/28" type="text" name="expiry_date" class="lms-input w-full"
                                    placeholder="MM/YY">
                                @error('expiry_date')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <input type="number" value="577" name="cvc" class="lms-input w-full" placeholder="CVC">
                                @error('cvc')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <input type="number" value="{{ number_format($invoice->calculation()['due'], 2) }}"
                                    name="amount" class="lms-input w-full" placeholder="Amount">
                                @error('amount')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <input type="hidden" value="{{ $invoice->id }}" name="invoice_id">
                            </div>
                        </div>
                        <input type="submit" value="Pay Now" class="lms-btn mt-4">
                    </form>
                    <form action="{{ route('cash') }}" method="POST" id="cashForm">
                        @csrf
                        <input type="number" name="amount"
                            value="{{ number_format($invoice->calculation()['due'], 2) }}" placeholder="Type Amount"
                            class="lms-input w-1/3">
                        <input type="hidden" value="{{ $invoice->id }}" name="invoice_id">
                        <input type="submit" value="Pay Now" class="lms-btn mt-4">
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('cashForm').style.display = 'none';
        document.getElementById('stripeForm').style.display = 'none';
        document.getElementById('card').addEventListener('click', function() {
                document.getElementById('stripeForm').style.display = 'block';
                document.getElementById('cashForm').style.display = 'none';
        });
        document.getElementById('cash').addEventListener('click', function() {
                document.getElementById('stripeForm').style.display = 'none';
                document.getElementById('cashForm').style.display = 'block';
        });
    </script>
</x-app-layout>