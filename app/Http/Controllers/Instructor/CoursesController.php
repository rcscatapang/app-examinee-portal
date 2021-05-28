<?php

namespace App\Http\Controllers\Instructor;

use App\Enums\CourseInviteStatus;
use App\Http\Controllers\Controller;
use App\Mail\CourseInviteMail;
use App\Models\Course;
use App\Models\CourseInvite;
use App\Traits\ManagesTransactions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    use ManagesTransactions;

    public function index()
    {
        $instructor = auth()->user()->instructor;
        $courses = Course::where('instructor_id', $instructor->id)->orderBy('name')->get();
        return view('instructor.courses.index', compact(['courses', 'instructor']));
    }

    public function invite(Request $request, Course $course): RedirectResponse
    {
        $input = $request->all();

        $response = $this->transaction(
            function () use ($input, $course) {
                $input['invite_code'] = strtoupper(Str::random(6));
                $input['course_id'] = $course->id;
                $course_invite = CourseInvite::create($input);
                Mail::to($input['email_address'])->send(new CourseInviteMail($course, $course_invite));
            }
        );

        if ($response['status_code'] !== Response::HTTP_OK) {
            abort(500);
        }
        return redirect()->back();
    }

    public function create()
    {
        return view('instructor.courses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        $input['instructor_id'] = auth()->user()->instructor->id;
        Course::create($input);

        return redirect()->route('instructor.courses');
    }

    public function show(Course $course)
    {
        $course_invites = $course->courseInvites->where('status', '!=', CourseInviteStatus::Accepted);
        $students = $course->students;
        return view('instructor.courses.show', compact(['course', 'course_invites', 'students']));
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
