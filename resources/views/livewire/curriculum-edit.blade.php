<form wire:submit.prevent="updateCurriculum">
    <div class="mb-4">
        @include('components.form-field', [
        'label' => 'Class Name',
        'type' => 'text',
        'name' => 'name',
        'required' => 'required',
        'placeholder' => 'Enter class name',
        'class' => 'w-1/2'
        ])
    </div>

    <div class="mb-4">
        @include('components.form-field', [
        'label' => 'Class Date',
        'type' => 'dateTime',
        'name' => 'date',
        'required' => 'required',
        'placeholder' => 'Enter class date',
        'class' => 'w-1/2 px-3 py-2'
        ])
    </div>

    @include('components.form-field', [
    'label' => 'Class Time',
    'type' => 'time',
    'name' => 'time',
    'required' => 'required',
    'placeholder' => 'Enter class time',
    'class' => 'w-1/2'
    ])

    @include('components.loading')

    <button wire:loading.delay.long.remove class="lms-btn mt-5" type="submit">Update</button>
</form>