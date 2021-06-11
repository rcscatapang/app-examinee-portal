<?php

namespace App\Http\Controllers\Student;

use App\Enums\ExamStatus;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        $courses = $student->courses->pluck('id');

        $current_date = Carbon::now();
        $upcoming_exams = Exam::whereIn('course_id', $courses)->where('status', ExamStatus::Published)
            ->whereDate('start_date', '>', $current_date)->orderBy('start_date', 'desc')->get();
        $ongoing_exams = Exam::whereIn('course_id', $courses)->where('status', ExamStatus::Published)
            ->whereDate('start_date', '<=', $current_date)->orderBy('start_date', 'desc')->get();

        return view('student.exams.index', compact(['upcoming_exams', 'ongoing_exams']));
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
