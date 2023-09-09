<?php

namespace App\Http\Middleware;

use App\Models\shetabit_visitt;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserActiveLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $ip = $request->ip();
$cacheid = 'last-visit'.$ip;
        $cacheDuration = Carbon::now()->addHour();

        if(!Cache::has($cacheid)){
            visitor()->visit();
            Cache::put($cacheid, true, $cacheDuration);
        }

        return $next($request);
    }
}
