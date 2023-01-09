<form wire:submit.prevent="addCourse">
    <div class="mb-5">
        @include('components.form-field', [
        'label' => 'Course Name',
        'type' => 'text',
        'name' => 'name',
        'placeholder' => 'Enter course name',
        'required' => 'required',
        'class' => 'w-1/2'
        ])
    </div>

    <div class="mb-5">
        @include('components.form-field', [
        'label' => 'Course Description',
        'type' => 'textarea',
        'name' => 'description',
        'placeholder' => 'Enter course description',
        'required' => 'required',
        'class' => 'w-1/2'
        ])
    </div>

    <div class="mb-6">
        @include('components.form-field', [
        'label' => 'Course Price',
        'type' => 'number',
        'name' => 'price',
        'placeholder' => 'Enter course price',
        'required' => 'required',
        'class' => 'w-1/2'
        ])
    </div>

    <div class="mb-6">
        <label class="lms-label">Course Days</label>
        <div class="flex items-center flex-wrap">
            @foreach ($days as $day)
            <div class="flex items-center mr-4">
                <input wire:model="selected_days" type="checkbox" id="{{ $day }}" value="{{ $day }}" class="mr-2">
                <label class="cursor-pointer" for="{{ $day }}">{{ $day }}</label>
            </div>
            @endforeach
        </div>
        @error('selected_days')
        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-6">
        @include('components.form-field', [
        'label' => 'Course Time',
        'type' => 'time',
        'name' => 'time',
        'placeholder' => 'Enter course price',
        'required' => 'required',
        'class' => 'w-1/2'
        ])
    </div>

    <div class="mb-6">
        @include('components.form-field', [
        'label' => 'Course End Date',
        'type' => 'date',
        'name' => 'end_date',
        'placeholder' => 'Enter course end date',
        'required' => 'required',
        'class' => 'w-1/2'
        ])
    </div>

    @include('components.loading')

    <button wire:loading.delay.long.remove class="lms-btn" type="submit">Add Course</button>
</form>