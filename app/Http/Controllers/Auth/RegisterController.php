<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserType as UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );
    }

    protected function create(array $data)
    {
        return User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'user_type' => $data['user_type'],
                'password' => Hash::make($data['password']),
            ]
        );
    }

    protected function redirectTo(): string
    {
        $user = auth()->user();
        if ($user->user_type === UserTypeEnum::Student) {
            return route('student.dashboard');
        } else {
            return route('instructor.dashboard');
        }
    }
}
