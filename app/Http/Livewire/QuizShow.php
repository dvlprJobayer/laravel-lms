<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class QuizShow extends Component
{
    public $quiz;
    public $answer;
    
    public $options = ['answer_a', 'answer_b', 'answer_c', 'answer_d'];
    public function render()
    {
        return view('livewire.quiz-show');
    }

    public function result($question_id) {
        $question = Question::findOrFail($question_id);

        if($question->correct_answer === explode('-', $this->answer)[0]) {
            flash()->addSuccess('Correct Answer');
            
        } else {
            flash()->addError('Wrong Answer');
            
        }
    }
}
