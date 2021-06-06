<?php

namespace App\Http\Controllers\Instructor;

use App\Enums\StudentCourseStatus;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class StudentsController extends Controller
{
    public function index()
    {
        $table_headers = ['student code', 'first name', 'last name', 'email', 'contact number', 'gender'];
        return view('instructor.students.index', compact(['table_headers']));
    }

    public function show()
    {
        return view('instructor.students.show');
    }

    public function getDataTable(): JsonResponse
    {
        $instructor = auth()->user()->instructor;
        $courses_id = Course::where('instructor_id', $instructor->id)->pluck('id');
        $students_id = StudentCourse::whereIn('course_id', $courses_id)
            ->where('status', StudentCourseStatus::Active)
            ->distinct('student_id')->pluck('student_id');

        $students = Student::whereIn('id', $students_id);
        return DataTables::eloquent($students)->rawColumns(['action_column'])->toJson();
    }
}
