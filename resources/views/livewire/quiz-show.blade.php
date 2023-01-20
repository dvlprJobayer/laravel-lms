<div>
    @foreach ($quiz->questions as $question)
    <div class="mt-4">
        <h3 class="font-semibold text-lg mb-2">{{ $question->name }}</h3>
        <div class="flex items-center gap-x-4">
            @foreach ($options as $option)
            <div class="flex items-center gap-x-2">
                <input wire:model="answer" wire:change="result({{ $question->id }})"
                    value="{{ explode('_', $option)[1]. '-' .$question->id }}" type="radio"
                    id="{{ $option. '-' .$question->id }}">
                <label for="{{ $option. '-' .$question->id }}">{{ $question->$option
                    }}</label>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>