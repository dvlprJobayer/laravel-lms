<div>
    <table class="w-full">
        <tr>
            <th class="border px-4 py-2 text-left">Name</th>
            <th class="border px-4 py-2 text-left">Phone</th>
            <th class="border px-4 py-2 text-left">Email</th>
            <th class="border px-4 py-2">Registered</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
        @foreach ($leads as $lead)
        <tr>
            <td class="border px-4 py-2">{{ $lead->name }}</td>
            <td class="border px-4 py-2">{{ $lead->phone }}</td>
            <td class="border px-4 py-2">{{ $lead->email }}</td>
            <td class="border px-4 py-2 text-center">{{ date('F j Y', strtotime($lead->created_at)) }}</td>
            <td class="border px-4 py-2 text-center">
                <div class="flex items-center justify-around">
                    <a href="{{ route('leads.edit', $lead) }}">
                        @include('components.icons.edit')
                    </a>
                    <a href="{{ route('leads.show', $lead) }}">
                        @include('components.icons.view')
                    </a>

                    <form onsubmit="return confirm('Are you Sure?')" wire:submit.prevent="lead_delete({{ $lead->id }})">
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
        {{ $leads->links() }}
    </div>
</div>