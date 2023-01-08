<form wire:submit.prevent="addUser">
    <div class="flex gap-x-4">
        <div class="flex-1">
            <label class="lms-label" for="name">Name</label>
            <input wire:model="name" class="lms-input w-full" type="text" id="name">

            @error('name')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex-1">
            <label class="lms-label" for="email">Email</label>
            <input wire:model="email" class="lms-input w-full" type="email" id="email">

            @error('email')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="flex gap-x-4 mt-4">
        <div class="flex-1">
            <label class="lms-label" for="password">Password</label>
            <input wire:model="password" class="lms-input w-full" type="password" id="password">

            @error('password')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex-1">
            <label class="lms-label" for="role">Role</label>
            <select wire:model="role" class="lms-input w-full" id="role">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>

            @error('role')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>
    </div>

    @include('components.loading')

    <button wire:loading.delay.long.remove class="lms-btn mt-5" type="submit">Add User</button>
</form>