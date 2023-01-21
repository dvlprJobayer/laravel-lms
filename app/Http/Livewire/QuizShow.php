<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class QuizShow extends Component
{
    public $quiz;
    public $answer;
    public $answered = [];
    public $count_correct_answer;
    public $count_wrong_answer;
    public $options = ['answer_a', 'answer_b', 'answer_c', 'answer_d'];
    public function render()
    {
        return view('livewire.quiz-show');
    }

    public function result($question_id) {
        $question = Question::findOrFail($question_id);

        if($question->correct_answer === explode('-', $this->answer[$question_id])[0]) {
            flash()->addSuccess('Correct Answer');
            $this->answered[$question_id] = true;
            $this->count_correct_answer++;
        } else {
            flash()->addError('Wrong Answer');
            $this->answered[$question_id] = false;
            $this->count_wrong_answer++;
        }
    }
}
