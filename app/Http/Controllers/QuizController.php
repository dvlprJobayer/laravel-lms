<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index () {
        return view('quiz.index');
    }

    public function store() {
        request()->validate([
            'name' => 'required'
        ]);

        $quiz = Quiz::create([
            'name' => request('name')
        ]);

        flash()->addSuccess('Quiz created successfully');

        return redirect()->route('quiz.edit', $quiz->id);
    }

    public function show(Quiz $quiz) {
        return view('quiz.show', [
            'quiz' => $quiz
        ]);
    }

    public function edit(Quiz $quiz) { 
        return view('quiz.edit', [
            'id' => $quiz->id
        ]);
    }
}
