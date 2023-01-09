<div>
    <form wire:submit.prevent="updateForm">
        <div class="flex">
            <div class="flex-1">
                @include('components.form-field', [
                'label' => 'Name',
                'type' => 'text',
                'name' => 'name',
                'placeholder' => 'Lead name',
                'required' => 'required',
                'class' => 'w-full'
                ])
            </div>
            <div class="flex-1 mx-4">
                @include('components.form-field', [
                'label' => 'Phone',
                'type' => 'tel',
                'name' => 'phone',
                'placeholder' => 'Enter phone',
                'required' => 'required',
                'class' => 'w-full'
                ])
            </div>
            <div class="flex-1">
                @include('components.form-field', [
                'label' => 'Email',
                'type' => 'email',
                'name' => 'email',
                'placeholder' => 'Enter email',
                'required' => 'required',
                'class' => 'w-full'
                ])
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