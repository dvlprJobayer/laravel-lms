<div>
    <h2 class="text-xl underline text-gray-700 font-bold mb-2">{{ $course->name }}</h2>
    <h4>Price: ${{ $course->price }}</h4>
    <p class="my-4 w-3/4">{{ $course->description }}</p>

    <h3 class="text-lg font-bold mb-2">Classes</h3>

    <table class="w-full">
        <tr>
            <th class="border px-4 py-2 text-left">Name</th>
            <th class="border px-4 py-2">Date</th>
            <th class="border px-4 py-2">Time</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
        @foreach ($curriculums as $curriculum)
        <tr>
            <td class="border px-4 py-2">{{ $curriculum->name }}</td>
            <td class="border px-4 py-2 text-center">{{ date('F j Y', strtotime($curriculum->class_date)) }}</td>
            <td class="border px-4 py-2 text-center">{{ date('h:i:s A', strtotime($curriculum->class_time)) }}</td>
            <td class="border px-4 py-2 text-center">
                <div class="flex items-center justify-center gap-x-4">
                    <a href="{{ route('class.edit', $curriculum->id) }}">
                        @include('components.icons.edit')
                    </a>

                    <a href="{{ route('class.show', $curriculum->id) }}">
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
</div>