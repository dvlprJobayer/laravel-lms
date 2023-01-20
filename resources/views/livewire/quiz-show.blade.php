<div>
    @foreach ($quiz->questions as $question)
    <div
        class="mt-4 border border-gray-300 p-4 @if(array_key_exists($question->id, $correct_answers)) {{ $correct_answers[$question->id] ? 'bg-green-100' :  'bg-red-100' }} @endif">
        <h3 class="font-semibold text-lg mb-2">{{ $question->name }}</h3>
        <div class="flex items-center gap-x-4">
            @foreach ($options as $option)
            <div class="flex items-center gap-x-2">
                <input wire:model="answer" wire:change="result({{ $question->id }})"
                    value="{{ explode('_', $option)[1]. '-' .$question->id }}" type="radio"
                    id="{{ $option. '-' .$question->id }}" @if (array_key_exists($question->id, $correct_answers))
                disabled @endif class="disabled:text-gray-400">
                <label @if (array_key_exists($question->id, $correct_answers))
                    class="text-gray-400" @endif for="{{ $option. '-' .$question->id }}">{{ $question->$option
                    }}</label>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>