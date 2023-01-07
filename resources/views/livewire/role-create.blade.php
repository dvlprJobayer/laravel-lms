<form wire:submit.prevent="add_role">
    <div class="w-1/2">
        <label class="lms-label" for="name">Role Name</label>
        <input wire:model="name" class="lms-input w-full" type="text" id="name">

        @error('name')
        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="flex items-center gap-x-4 mt-4">
        @foreach ($permissions as $permission)
        <div class="flex items-center gap-x-2">
            <input class="cursor-pointer" wire:model="selected_permissions" type="checkbox" id="{{ $permission->id }}"
                value="{{ $permission->name }}">
            <label class="cursor-pointer" for="{{ $permission->id }}">{{ $permission->name }}</label>
        </div>
        @endforeach
    </div>
    @error('selected_permissions')
    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
    @enderror

    @include('components.loading')

    <button wire:loading.delay.long.remove class="lms-btn mt-5" type="submit">Add Role</button>
</form>