<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Notifications\CourseInviteNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CoursesController extends Controller
{
    public function index()
    {
        $instructor = auth()->user()->instructor;
        $courses = Course::where('instructor_id', $instructor->id)->orderBy('name')->get();
        return view('instructor.courses.index', compact(['courses', 'instructor']));
    }

    public function invite(Request $request, Course $course): RedirectResponse
    {
        $input = $request->all();
        Notification::route('mail', $input['email_address'])
            ->notify(new CourseInviteNotification($course, $input['email_address'], $input['name']));

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

    public function show()
    {
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
