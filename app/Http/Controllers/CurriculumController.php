<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function show($id) {
        return view('course.curriculum.single', [
            'curriculum_id' => $id
        ]);
    }

    public function edit($id) {
        return view('course.curriculum.edit', [
            'curriculum_id' => $id
        ]);
    }
}
