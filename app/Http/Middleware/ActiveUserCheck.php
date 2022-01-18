<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Alert;
class ActiveUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(auth()->user() && auth()->user()->is_active!=1){
            Alert::error('Something Went Wrong', 'Your account is not active');
            Auth::logout();
            return redirect('/unauthorized');

        }

        return $next($request);
    }
}
