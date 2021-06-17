<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function profile()
    {
        $instructor = auth()->user()->instructor;
        return view('instructor.profile', compact(['instructor']));
    }
}
