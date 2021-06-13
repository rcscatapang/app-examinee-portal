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
        $table_headers = ['', 'student code', 'first name', 'last name', 'email', 'contact number', 'gender', ''];
        return view('instructor.students.index', compact(['table_headers']));
    }

    public function show(Student $student)
    {
        $instructor = auth()->user()->instructor;
        $student_courses = $student->courses->where('instructor_id', $instructor->id);
        return view('instructor.students.show', compact(['student', 'student_courses']));
    }

    public function getDataTable(): JsonResponse
    {
        $instructor = auth()->user()->instructor;
        $courses_id = Course::where('instructor_id', $instructor->id)->pluck('id');
        $students_id = StudentCourse::whereIn('course_id', $courses_id)
            ->where('status', StudentCourseStatus::Active)
            ->distinct('student_id')->pluck('student_id');

        $students = Student::whereIn('id', $students_id);
        return DataTables::eloquent($students)
            ->addColumn(
                'action_column',
                function ($student) {
                    $route = route('instructor.students.show', ['student' => $student->id]);
                    return '<a href="' . $route . '" class="table-action"><i class="fas fa-chevron-right"></i></a>';
                }
            )
            ->addColumn(
                'photo_column',
                function ($student) {
                    $photo = '<img src="' . asset('/student/' . $student->photo) . '">';
                    return '<a href="#!" class="avatar avatar-sm rounded-circle">' . $photo . '</a>';
                }
            )
            ->rawColumns(['action_column', 'photo_column'])
            ->toJson();
    }
}
