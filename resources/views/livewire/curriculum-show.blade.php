<div>
    <h2 class="text-xl underline text-gray-700 font-bold mb-2">{{ $curriculum->course->name }}</h2>
    <h4>Price: ${{ $curriculum->course->price }}</h4>
    <p class="my-4 w-3/4">{{ $curriculum->course->description }}</p>

    <h3 class="text-lg font-bold text-gray-700 mb-2">Class</h3>
    <h4 class="font-bold text-gray-700">{{ $curriculum->name }}</h4>
    <h6 class="my-1">{{ date('F j Y', strtotime($curriculum->class_date)) }}</h6>
    <h6>{{ date('h:i A', strtotime($curriculum->class_time)) }}</h6>
    <h5 class="font-bold text-gray-700 my-2">Students | Present - {{ $curriculum->present_students() }} | Absent - {{
        $curriculum->course->students->count() - $curriculum->present_students() }}</h5>

    <table class="w-full">
        <tr>
            <th class="border px-4 py-2 text-left">Name</th>
            <th class="border px-4 py-2 text-left">Email</th>
            <th class="border px-4 py-2 text-left">Attendance</th>
        </tr>
        @foreach ($curriculum->course->students as $student)
        <tr>
            <td class="border px-4 py-2">{{ $student->name }}</td>
            <td class="border px-4 py-2">{{ $student->email }}</td>
            <td class="border px-4 py-2">
                <div class="flex items-center justify-center gap-x-4">
                    @if ($student->is_present($curriculum->id))
                    Presented
                    @else
                    <button class="lms-btn" wire:click="attendance({{ $student->id }})">
                        Present
                    </button>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="mt-6">
        <hr>
        <h2 class="font-bold text-gray-700 my-2">Notes</h2>
        @if(count($notes) > 0)
        <table class="w-full">
            <tr>
                <th class="border px-4 py-2 text-left">Name</th>
                <th class="border px-4 py-2 text-left">Email</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
            @foreach ($notes as $note)
            <tr>
                <td class="border px-4 py-2">{{ $note->title }}</td>
                <td class="border px-4 py-2">{{ $note->description }}</td>
                <td class="border px-4 py-2">
                    <div class="flex items-center justify-center gap-x-4">
                        <form onsubmit="return confirm('Are you Sure?')"
                            wire:submit.prevent="deleteNote({{ $note->id }})">
                            <button type="submit">
                                @include('components.icons.delete')
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <p class="text-gray-700">No notes yet.</p>
        @endif
        <h4 class="text-purple-500 text-lg font-bold pt-4 pb-2">Add New Note</h4>
        <form wire:submit.prevent="addNote">
            <input wire:model="note_title" class="lms-input w-1/2 mb-4" type="text" placeholder="Title">
            <textarea wire:model="note_body" class="lms-input w-1/2" rows="5" placeholder="Body"></textarea>
            @include('components.loading')
            <button wire:loading.delay.long.remove class="lms-btn mt-5" type="submit">Save</button>
        </form>
    </div>
</div>