<?php

namespace TCG\Voyager\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

class VoyagerAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if (!Auth::guest()) {
            return auth()->user()->hasPermission('browse_admin') ? $next($request) : redirect('/');
            // return auth()->user()->hasRole('admin') ? $next($request) : redirect('/');
         }

        $urlLogin = route('voyager.login');

        return redirect()->guest($urlLogin);
    }
}
