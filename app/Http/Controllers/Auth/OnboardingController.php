<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OnboardingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function onboarding()
    {
        $user = auth()->user();
        if ($user->account_verified_at) {
            return redirect('/');
        }

        return view('auth.onboarding', compact(['user']));
    }

    public function complete(Request $request): RedirectResponse
    {
        $input = $request->all();
        $user = User::find($input['user_id']);
        $user->account_verified_at = Carbon::now();
        $user->save();

        if ($request->hasFile('file')) {
            $request->file->store('student', 'public');
            $input['photo'] = $request->file->hashName();
        }

        switch ($input['user_type']) {
            case UserType::Student:
                Student::create($input);
                return redirect()->route('dashboard');
            case UserType::Instructor:
                $input['code'] = Str::uuid();
                Instructor::create($input);
                return redirect()->route('instructor.dashboard');
            default:
                return redirect()->back();
        }
    }
}
