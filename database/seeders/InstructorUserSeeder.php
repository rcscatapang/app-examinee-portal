<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Instructor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstructorUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create(
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('secret'),
                'user_type' => UserType::Instructor,
                'account_verified_at' => Carbon::now(),
                'email_verified_at' => Carbon::now()
            ]
        );

        Instructor::create(
            [
                'user_id' => $user->id,
                'code' => 'INSTR001',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'contact_number' => '+639171234567',
                'institution' => 'Harvard University'
            ]
        );
    }
}
