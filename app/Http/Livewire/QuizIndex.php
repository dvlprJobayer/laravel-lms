<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithPagination;

class QuizIndex extends Component
{
    use WithPagination;
    public function render()
    {
        $quizzes = Quiz::paginate(10);
        return view('livewire.quiz-index', compact('quizzes'));
    }

    public function deleteQuiz($id) {
        Quiz::findOrFail($id)->delete();
        flash()->addSuccess('Quiz deleted successfully');
    }
}
