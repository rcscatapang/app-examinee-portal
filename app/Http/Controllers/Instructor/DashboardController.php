<?php

namespace App\Http\Controllers\Instructor;

use App\Enums\ExamStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $instructor = auth()->user()->instructor;
        $courses = $instructor->courses;

        $active_courses = $courses->count();
        $enrolled_students = 0;
        $scheduled_exams = 0;
        foreach ($courses as $course) {
            $enrolled_students += $course->students->count();
            $scheduled_exams += $course->exams->where('status', ExamStatus::Published)->count();
        }

        return view('instructor.dashboard', compact(['active_courses', 'enrolled_students', 'scheduled_exams']));
    }
}
