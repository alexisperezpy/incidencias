<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!auth()->check())
            return redirect('login');
            
        if(auth()->user()->role != 0)
            return redirect('home');
        
        return $next($request);
    }
}
