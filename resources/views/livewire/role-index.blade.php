<table class="w-full">
    <tr>
        <th class="border px-4 py-2 text-left">Name</th>
        <th class="border px-4 py-2 text-left">Permissions</th>
        <th class="border px-4 py-2">Registered</th>
        <th class="border px-4 py-2">Actions</th>
    </tr>
    @foreach ($roles as $role)
    <tr>
        <td class="border px-4 py-2">{{ $role->name }}</td>
        <td class="border px-4 py-2">
            @foreach ($role->permissions as $permission)
            <span class="px-2 py-1 bg-purple-500 text-white rounded-md text-sm">{{ $permission->name }}</span>
            @endforeach
        </td>
        <td class="border px-4 py-2 text-center">{{ date('F j Y', strtotime($role->created_at)) }}</td>
        <td class="border px-4 py-2 text-center">
            <div class="flex items-center justify-center gap-x-4">
                <a href="{{ route('role.edit', $role->id) }}">
                    @include('components.icons.edit')
                </a>

                <form class="mt-1" onsubmit="return confirm('Are you Sure?')"
                    wire:submit.prevent="roleDelete({{ $role->id }})">
                    <button type="submit">
                        @include('components.icons.delete')
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</table>