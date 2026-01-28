<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    
    public function handle(Request $request, Closure $next): Response
    {
        $age = session('age');
        if (!is_numeric($age) || $age < 18) {
            return response('Không được phép truy cập', 403);
        }
        return $next($request);
    }
}
