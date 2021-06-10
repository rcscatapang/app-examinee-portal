<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function index()
    {
        return view('student.exams.index');
    }

    public function show(Exam $exam)
    {
        return view('student.exams.show', compact(['exam']));
    }

    public function answer(Exam $exam, Question $question)
    {
        return redirect('student.exams', compact(['exam', 'question']));
    }

    public function submit(Exam $exam, Question $question, Request $request)
    {
    }

    public function complete(Exam $exam)
    {
        return view('student.exams.show', compact(['exam']));
    }
}
