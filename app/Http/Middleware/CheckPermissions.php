<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Route;

class CheckPermissions
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
        $route = Route::current();
        $uri = ($route->uri !== '/') ? '/' . $route->uri : $route->uri;
        
        if (env('APP_ENV') != 'local'){
            if (Auth::check()) {
                $userId = Auth::user()->id;

                $sqlPermissions = "SELECT *
                FROM permissions
                INNER JOIN roles
                ON (permissions.role_id = roles.id)
                WHERE user_id = $userId
                AND roles.uri = '$uri'";

                $permissions = DB::select($sqlPermissions);

                if (empty($permissions)) {
                    return redirect()->route('forbidden');
                }
            } else {
                return redirect()->route('forbidden');
            }
        }

        return $next($request);
    }
}
