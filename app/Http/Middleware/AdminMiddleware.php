<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == "admin") {
            return $next($request);
        } else {
             auth()->logout();
            
            return redirect()->route('home')->with([
                'message' => "Please Login First",
                'classes' => "red"
            ]);
        }
    }
}
