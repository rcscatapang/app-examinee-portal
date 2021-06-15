<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamDetail;
use App\Models\StudentAnswer;

class ExamDetailsController extends Controller
{
    public function show(ExamDetail $exam_detail)
    {
        $exam = $exam_detail->exam;
        $student = $exam_detail->student;

        $questions = $exam->questions;
        foreach ($questions as $question) {
            $correct_answers = $question->options()->where('is_correct', true)->pluck('id')->toArray();
            $student_answers = StudentAnswer::where('exam_detail_id', $exam_detail->id)
                ->where('question_id', $question->id)->pluck('option_id')->toArray();
            $question->student_answers = $student_answers;
            $diff = array_diff($correct_answers, $student_answers);
            $question->is_correct = count($diff) == 0;
        }

        return view('student.exam_details.show', compact(['exam_detail', 'exam', 'questions', 'student']));
    }
}
