<?php

namespace App\Providers;

use App\Enums\UserType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $current_user = \auth()->user();
                $app_data['currentUser'] = Auth::user();
                if ($current_user->user_type === UserType::Student) {
                    $app_data['courses'] = $current_user->student->courses->sortBy('name');
                }

                $view->with('app_data', $app_data);
            }
        });
    }
}
