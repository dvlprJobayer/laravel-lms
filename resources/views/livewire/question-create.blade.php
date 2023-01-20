<form wire:submit.prevent="addQuestion">
    <div class="mb-5">
        @include('components.form-field', [
        'label' => 'Question Name',
        'type' => 'text',
        'name' => 'name',
        'placeholder' => 'Enter question name',
        'required' => 'required',
        'class' => 'w-1/2'
        ])
    </div>

    @foreach ($answers as $answer)
    <div class="mb-5">
        @include('components.form-field', [
        'label' => 'Answer ' . $answer,
        'type' => 'text',
        'name' => 'answer_' . $answer,
        'placeholder' => 'Enter answer ' . $answer,
        'required' => 'required',
        'class' => 'w-1/2'
        ])
    </div>
    @endforeach

    <div class="mb-5">
        <label for="correct-answer" class="lms-label">Correct Answer</label>
        <select wire:model="correct_answer" id="correct-answer" class="lms-input w-1/2">
            @foreach ($answers as $answer)
            <option value="{{ $answer }}">Answer {{ Str::ucfirst($answer) }}</option>
            @endforeach
        </select>
        @error('correct_answer')
        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
        @enderror
    </div>

    @include('components.loading')
    <button wire:loading.delay.long.remove class="lms-btn" type="submit">Add Question</button>
</form>