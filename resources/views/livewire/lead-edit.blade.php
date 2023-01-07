<div>
    <form wire:submit.prevent="updateForm">
        <div class="flex">
            <div class="flex-1">
                <label class="lms-label" for="">Name</label>
                <input wire:model="name" class="lms-input w-full" type="text" name="" id="">

                @error('name')
                <div class="text-red-500 text-sm my-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-1 mx-4">
                <label class="lms-label" for="">Phone</label>
                <input wire:model="phone" class="lms-input w-full" type="tel" name="" id="">

                @error('phone')
                <div class="text-red-500 text-sm my-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-1">
                <label class="lms-label" for="">Email</label>
                <input wire:model="email" class="lms-input w-full" type="email" name="" id="">

                @error('email')
                <div class="text-red-500 text-sm my-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        @include('components.loading')

        <button wire:loading.delay.long.remove class="lms-btn mt-5" type="submit">Update</button>
    </form>

    <div class="mt-6">
        <hr>
        <h2 class="text-xl text-purple-500 font-bold my-2">Notes</h2>
        @foreach ($notes as $note)
        <div class="mb-2">
            <h3 class="text-lg text-gray-700 font-bold">{{ $note->title }}</h3>
            <p>{{ $note->description }}</p>
        </div>
        @endforeach
        <h4 class="text-xl text-purple-500 font-bold py-2">Add New Note</h4>
        <form wire:submit.prevent="addNote">
            <input wire:model="note_title" class="lms-input w-1/2 mb-4" type="text" name="" id="note-name"
                placeholder="Title">
            <textarea wire:model="note_description" class="lms-input w-1/2" name="" id="note-description" rows="5"
                placeholder="Description"></textarea>
            <button type="submit" class="lms-btn mt-5">Save</button>
        </form>
    </div>
</div>