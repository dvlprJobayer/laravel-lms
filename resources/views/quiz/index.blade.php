<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quiz') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('quiz.store') }}" method="POST">
                        @csrf
                        <label for="quiz" class="lms-label">Quiz Name</label>
                        <input type="text" name="name" id="quiz" class="lms-input w-1/2" placeholder="Enter Quiz Name">
                        @error('name')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                        <input type="submit" class="lms-btn mt-5" value="Add New Quiz">
                    </form>

                    <livewire:quiz-index />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>