<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if( Auth::Check() && Auth::user()->status == 1){
            Auth::logout();

            return redirect('/login')->with('AuthError', 'Hesabınız Yasaklanmıştır.');

        }

        return $next($request);
    }
}
