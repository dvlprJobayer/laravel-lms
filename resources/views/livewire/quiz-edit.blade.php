<div>
    <h2 class="font-bold text-lg mb-4">Questions</h2>
    <form wire:submit.prevent="addQuestion">
        <label class="lms-label" for="edit-quiz">Add Question</label>
        <select wire:model="question_id" id="edit-quiz" class="lms-input w-1/2">
            <option value="">Select Question</option>
            @foreach ($questions as $question)
            <option value="{{ $question->id }}">{{ $question->name }}</option>
            @endforeach
        </select>
        @include('components.loading')
        <button wire:loading.delay.long.remove class="lms-btn mt-5" type="submit">Add Question</button>
    </form>
</div>