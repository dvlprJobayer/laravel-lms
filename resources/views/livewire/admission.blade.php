<div>
    <form wire:submit.prevent="search" class="flex items-center gap-x-4 mb-6">
        <input wire:model="search" type="text" class="lms-input w-full">
        <button type="submit" class="lms-btn">Search</button>
    </form>

    @if (count($leads) > 0)
    <form wire:submit.prevent="admit">
        <select wire:model="lead_id" class="lms-input w-2/3">
            <option value="">Select Lead</option>
            @foreach ($leads as $lead)
            <option value="{{ $lead->id }}">{{ $lead->name }} - {{ $lead->phone }} - {{ $lead->email }}</option>
            @endforeach
        </select>

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
    @elseif (!empty($search) && $not_found)
    <p>No leads found</p>
    <h3 class="font-semibold mt-2">Add Student</h3>
    <form wire:submit.prevent="addStudent">
        <div class="flex items-center mt-2 gap-x-4">
            <div class="w-full">
                @include('components.form-field', [
                'label' => 'Name',
                'type' => 'text',
                'name' => 'name',
                'placeholder' => 'Enter name',
                'required' => 'required',
                'class' => 'w-full',
                ])
            </div>
            <div class="w-full">
                @include('components.form-field', [
                'label' => 'Email',
                'type' => 'email',
                'name' => 'email',
                'placeholder' => 'Enter email',
                'required' => 'required',
                'class' => 'w-full',
                ])
            </div>
            <div class="w-full">
                @include('components.form-field', [
                'label' => 'password',
                'type' => 'password',
                'name' => 'password',
                'placeholder' => 'Enter password',
                'required' => 'required',
                'class' => 'w-full',
                ])
            </div>
        </div>
        @if(empty($user_id))
        @include('components.loading')
        <button wire:loading.delay.long.remove class="lms-btn mt-4" type="submit">Add Student</button>
        @endif
    </form>

    <form wire:submit.prevent="studentAdmit">
        @if (!empty($user_id))
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
    @endif
</div>