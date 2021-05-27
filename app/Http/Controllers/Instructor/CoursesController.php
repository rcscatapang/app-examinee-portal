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
    }

    public function store()
    {
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
