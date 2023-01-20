<?php

namespace App\Http\Livewire;

use App\Models\Question;
use App\Models\Quiz;
use Livewire\Component;

class QuizEdit extends Component
{
    public $quiz_id;
    public $question_id;
    public $quiz_name;

    public function mount()
    {
        $this->quiz_name = Quiz::findOrFail($this->quiz_id)->name;
    }
    public function render()
    {
        $quiz = Quiz::findOrFail($this->quiz_id);
        return view('livewire.quiz-edit', [
            'quiz' => $quiz,
            'questions' => Question::select('id', 'name')->whereNotIn('id', $quiz->questions->pluck('id'))->get()
        ]);
    }

    public function addQuestion() {
        $quiz = Quiz::findOrFail($this->quiz_id);
        $quiz->questions()->attach($this->question_id);
        $this->question_id = null;

        flash()->addSuccess('Question added successfully');
    }

    public function removeQuestion($question_id) {

        $quiz = Quiz::findOrFail($this->quiz_id);
        $quiz->questions()->detach($question_id);

        flash()->addSuccess('Question removed successfully');
    }

    public function editQuiz() {
        $this->validate([
            'quiz_name' => 'required'
        ]);

        $quiz = Quiz::findOrFail($this->quiz_id);
        $quiz->name = $this->quiz_name;
        $quiz->save();

        flash()->addSuccess('Quiz updated successfully');
    }
}
