<?php

namespace App\Http\Controllers\Student;

use App\Enums\CourseInviteStatus;
use App\Enums\StudentCourseStatus;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseInvite;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Traits\ManagesTransactions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    use ManagesTransactions;

    public function join()
    {
        return view('student.courses.join');
    }

    public function search(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $course_invite = CourseInvite::where('email_address', $user->email)
            ->where('invite_code', $request['invite_code'])
            ->where('status', CourseInviteStatus::Pending)->first();

        if ($course_invite) {
            return redirect()->route('courses.show', $course_invite->course_id);
        }

        return redirect()->back();
    }

    public function enroll(Request $request): RedirectResponse
    {
        $input = $request->all();
        $student = Student::find($input['student_id']);
        $student_course = StudentCourse::where('course_id', $input['course_id'])
            ->where('student_id', $input['student_id'])->first();

        if (!$student_course) {
            $course_invite = CourseInvite::where('email_address', $student->email)
                ->where('invite_code', $request['invite_code'])->first();
            $course_invite->status = CourseInviteStatus::Accepted;
            $course_invite->save();

            $course = Course::find($input['course_id']);
            StudentCourse::create(
                [
                    'student_id' => $input['student_id'],
                    'course_id' => $input['course_id'],
                    'status' => StudentCourseStatus::Active
                ]
            );
            return redirect()->route('courses.show', $course->id);
        }

        return redirect()->back();
    }

    public function show(Course $course)
    {
        $instructor = $course->instructor;
        $student = auth()->user()->student;
        $student_course = StudentCourse::where('course_id', $course->id)
            ->where('student_id', $student->id)->first();
        $student->is_enrolled = (bool)$student_course;

        return view('student.courses.show', compact(['course', 'instructor', 'student']));
    }
}
