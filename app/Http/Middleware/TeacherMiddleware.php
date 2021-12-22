<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TeacherMiddleware
{
   
     
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == "teacher") {
           
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
