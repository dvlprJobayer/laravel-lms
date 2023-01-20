<div class="mt-6">
    <table class="w-full">
        <tr>
            <th class="border px-4 py-2 text-left">Name</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
        @foreach ($quizzes as $quiz)
        <tr>
            <td class="border px-4 py-2">{{ $quiz->name }}</td>
            <td class="border px-4 py-2 text-center">
                <div class="flex items-center justify-center gap-x-4">
                    <a href="{{ route('quiz.edit', $quiz->id) }}">
                        @include('components.icons.edit')
                    </a>
                    <a href="{{ route('quiz.show', $quiz->id) }}">
                        @include('components.icons.view')
                    </a>

                    <form wire:submit.prevent="deleteQuiz({{ $quiz->id }})">
                        <button onclick="return confirm('Are you Sure want to delete?')">
                            @include('components.icons.delete')
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="mt-4">
        {{ $quizzes->links() }}
    </div>
</div>