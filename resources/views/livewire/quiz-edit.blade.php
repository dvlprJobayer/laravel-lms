<div>
    <form wire:submit.prevent="editQuiz" class="mb-5">
        <div class="mb-5">
            @include('components.form-field', [
            'label' => 'Edit Quiz Name',
            'type' => 'text',
            'name' => 'quiz_name',
            'placeholder' => 'Quiz Name',
            'required' => 'required',
            'class' => 'w-1/2'
            ])
        </div>
        @include('components.loading')
        <button wire:loading.delay.long.remove class="lms-btn" type="submit">Edit Quiz</button>
    </form>
    @if (count($questions) > 0)
    <form wire:submit.prevent="addQuestion" class="mb-5">
        <label class="lms-label" for="edit-quiz">Add Question</label>
        <select wire:model="question_id" id="edit-quiz" class="lms-input w-1/2 cursor-pointer">
            <option value="">Select Question</option>
            @foreach ($questions as $question)
            <option value="{{ $question->id }}">{{ $question->name }}</option>
            @endforeach
        </select>
        @include('components.loading')
        <button wire:loading.delay.long.remove class="lms-btn mt-5" type="submit">Add Question</button>
    </form>
    @else
    <h3 class="font-bold text-lg">Add Question</h3>
    <div class="text-gray-500 mb-4">No Questions Available</div>
    @endif

    <h2 class="mb-2 font-bold text-lg">Questions</h2>
    @if ($quiz->questions->count() > 0)
    <table class="w-full">
        <tr>
            <th class="border px-4 py-2 text-left">Name</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
        @foreach ($quiz->questions as $question)
        <tr>
            <td class="border px-4 py-2">{{ $question->name }}</td>
            <td class="border px-4 py-2 text-center">
                <div class="flex items-center justify-center gap-x-4">
                    <button onclick="confirm('Are you sure want to delete?') || event.stopImmediatePropagation()"
                        wire:click="removeQuestion({{ $question->id }})">
                        @include('components.icons.delete')
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <div class="text-gray-500">No Questions Added</div>
    @endif
</div>