<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Route;

class VerifyLogin
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
        if (env('APP_ENV') != 'local'){
            if (Auth::check()) {
                return $next($request);
            } else {
                return redirect()->route('forbidden');
            }
        }

        return $next($request);
    }
}
