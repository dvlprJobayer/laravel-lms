<div>
    <form wire:submit.prevent="search" class="flex items-center gap-x-4 mb-6">
        <input wire:model="search" type="text" class="lms-input w-full">
        <button type="submit" class="lms-btn">Search</button>
    </form>

    <form wire:submit.prevent="admit">
        @if (count($leads) > 0)
        <select wire:model="lead_id" class="lms-input w-2/3">
            <option value="">Select Lead</option>
            @foreach ($leads as $lead)
            <option value="{{ $lead->id }}">{{ $lead->name }} - {{ $lead->phone }} - {{ $lead->email }}</option>
            @endforeach
        </select>
        @endif

        @if (!empty($lead_id))
        <select wire:change="courseSelect" wire:model="course_id" class="lms-input w-1/3 my-5">
            <option value="">Select Course</option>
            @foreach ($courses as $course)
            <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
        @endif

        @if (!empty($selected_course))
        <p>Price ${{ number_format($selected_course->price, 2) }}</p>

        <input wire:model="payment" type="number" max="{{ number_format($selected_course->price, 2) }}" step="0.01"
            class="lms-input w-1/3 my-4" placeholder="payment">

        @include('components.loading')

        <button wire:loading.delay.long.remove class="lms-btn" type="submit">Enroll</button>
        @endif
    </form>
</div>