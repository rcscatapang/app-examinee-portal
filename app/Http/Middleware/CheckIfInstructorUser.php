<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;

class CheckIfInstructorUser
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_type = $request->user()->user_type;
        if ($user_type !== UserType::Instructor) {
            if ($user_type === UserType::Student) {
                // Redirect to student dashboard
            } else {
                abort(404);
            }
        }

        return $next($request);
    }
}
