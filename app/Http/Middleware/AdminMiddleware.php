<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Admin;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Admin::all()->count();
        if (!($user == 1)) {
          // dd(Auth::guard('admin'));
            if (!Auth::guard('admin')->user()->hasPermissionTo('Administer roles & permissions')) //If user does //not have this permission
        {
                abort('401');
            }
        }

        return $next($request);
    }
}
