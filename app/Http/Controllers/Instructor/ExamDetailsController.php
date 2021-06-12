<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\ExamDetail;

class ExamDetailsController extends Controller
{
    public function show(ExamDetail $exam_detail)
    {
        $exam = $exam_detail->exam;
        $student = $exam_detail->student;
        return view('instructor.exam_details.show', compact(['exam_detail', 'exam', 'student']));
    }
}
