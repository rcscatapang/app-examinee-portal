<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function profile()
    {
        $student = auth()->user()->student;
        return view('instructor.profile', compact(['student']));
    }
}
