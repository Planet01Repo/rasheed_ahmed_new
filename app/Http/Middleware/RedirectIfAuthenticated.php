<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
       
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->hasAnyRole(['superadmin']) ) {
                return redirect(route('superadmin.home'));
            }else if (Auth::user()->hasAnyRole(['admin']) ) {
                return redirect(route('admin.home'));
            }else if (Auth::user()->hasAnyRole(['employee']) ) {
                return redirect(route('employee.home'));
            }
            return redirect('/home');
        }

        return $next($request);

    }
}
