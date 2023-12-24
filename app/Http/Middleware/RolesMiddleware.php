<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesMiddleware
{

    /**
     * @param Request $request
     * @param Closure $next
     * @param $roles
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
//        if (!Auth::check())
//            return redirect('/login');
            foreach ($roles as $role){
                if (Auth::user()->roles['0'] == $role)
                    return $next($request);
            }
        return redirect('/');
    }
}
