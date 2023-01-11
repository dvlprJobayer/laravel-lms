<table class="w-full">
    <tr>
        <th class="border px-4 py-2 text-left">Name</th>
        <th class="border px-4 py-2">Price</th>
        <th class="border px-4 py-2">Start Date</th>
        <th class="border px-4 py-2">End Date</th>
        <th class="border px-4 py-2">Actions</th>
    </tr>
    @foreach ($courses as $course)
    <tr>
        <td class="border px-4 py-2">{{ $course->name }}</td>
        <td class="border px-4 py-2 text-center"><span class="font-bold">$</span> {{ $course->price }}</td>
        <td class="border px-4 py-2 text-center">{{ date('F j Y', strtotime($course->created_at)) }}</td>
        <td class="border px-4 py-2 text-center">{{ date('F j Y', strtotime($course->end_date)) }}</td>
        <td class="border px-4 py-2 text-center">
            <div class="flex items-center justify-center gap-x-4">
                <a href="">
                    @include('components.icons.edit')
                </a>

                <a href="{{ route('course.show', $course->id) }}">
                    @include('components.icons.view')
                </a>

                <form class="mt-1" onsubmit="return confirm('Are you Sure?')"
                    wire:submit.prevent="deleteCourse({{ $course->id }})">
                    <button type="submit">
                        @include('components.icons.delete')
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</table>