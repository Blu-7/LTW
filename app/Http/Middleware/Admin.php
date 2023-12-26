<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $is_admin)
    {
        if(auth()->check() && (auth()->user()->is_admin == $is_admin || auth()->user()->is_admin == 1)){
            return $next($request);
        }
        abort(403);
        return response()->json(["Access Denied"]);
    }
}
