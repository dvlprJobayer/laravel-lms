<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionIndex extends Component
{
    use WithPagination;
    public function render()
    {
        $questions = Question::paginate(10);
        return view('livewire.question-index', compact('questions'));
    }

    public function deleteQuestion ($id) {
        Question::find($id)->delete();
        flash()->addSuccess('Question deleted successfully');
    }
}
