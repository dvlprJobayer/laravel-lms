<label class="lms-label" for="{{ $name }}">{{ $label }}</label>

@if ($type == 'textarea')

<textarea wire:model="{{ $name }}" class="lms-input {{ $class }}" id="{{ $name }}" rows="5"
    placeholder="{{ $placeholder }}" {{ $required }}></textarea>

@else

<input wire:model="{{ $name }}" class="lms-input {{ $class }}" type="{{ $type }}" id="{{ $name }}"
    placeholder="{{ $placeholder }}" {{ $required }}>

@endif

@error($name)
<div class="text-red-500 text-sm mt-2">{{ $message }}</div>
@enderror