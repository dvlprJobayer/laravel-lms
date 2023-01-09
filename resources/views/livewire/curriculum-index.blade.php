<table class="w-full">
    <tr>
        <th class="border px-4 py-2 text-left">Name</th>
        <th class="border px-4 py-2 text-left">Instructor</th>
        <th class="border px-4 py-2">Date</th>
        <th class="border px-4 py-2">Time</th>
        <th class="border px-4 py-2">Actions</th>
    </tr>
    @foreach ($curriculums as $curriculum)
    <tr>
        <td class="border px-4 py-2">{{ $curriculum->name }}</td>
        <td class="border px-4 py-2">{{ $course->user->name }}</td>
        <td class="border px-4 py-2 text-center">{{ date('F j Y', strtotime($curriculum->class_date)) }}</td>
        <td class="border px-4 py-2 text-center">{{ date('h:i:s A', strtotime($curriculum->class_time)) }}</td>
        <td class="border px-4 py-2 text-center">
            <div class="flex items-center justify-center gap-x-4">
                <a href="">
                    @include('components.icons.edit')
                </a>

                <a href="">
                    @include('components.icons.view')
                </a>

                <form class="mt-1" onsubmit="return confirm('Are you Sure?')"
                    wire:submit.prevent="deleteClass({{ $curriculum->id }})">
                    <button type="submit">
                        @include('components.icons.delete')
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</table>