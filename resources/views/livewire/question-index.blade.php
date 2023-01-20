<div>
    <table class="w-full">
        <tr>
            <th class="border px-4 py-2 text-left">Name</th>
            <th class="border px-4 py-2 text-left">Answer A</th>
            <th class="border px-4 py-2 text-left">Answer B</th>
            <th class="border px-4 py-2 text-left">Answer C</th>
            <th class="border px-4 py-2 text-left">Answer D</th>
            <th class="border px-4 py-2 text-left">Correct Answer</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
        @foreach ($questions as $question)
        <tr>
            <td class="border px-4 py-2">{{ $question->name }}</td>
            <td class="border px-4 py-2">{{ $question->answer_a }}</td>
            <td class="border px-4 py-2">{{ $question->answer_b }}</td>
            <td class="border px-4 py-2">{{ $question->answer_c }}</td>
            <td class="border px-4 py-2">{{ $question->answer_d }}</td>
            <td class="border px-4 py-2">{{ $question->correct_answer }}</td>
            <td class="border px-4 py-2 text-center">
                <div class="flex items-center justify-center gap-x-4">
                    <a href="{{ route('question.edit', $question->id) }}">
                        @include('components.icons.edit')
                    </a>

                    <form class="mt-1" onsubmit="return confirm('Are you Sure?')"
                        wire:submit.prevent="deleteQuestion({{ $question->id }})">
                        <button type="submit">
                            @include('components.icons.delete')
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="mt-5">
        {{ $questions->links() }}
    </div>
</div>