<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckTimeAccess
{
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::now();
        $start = Carbon::createFromFormat('H:i:s', '00:00:00');
        $end   = Carbon::createFromFormat('H:i:s', '23:00:00');


        if ($now->between($start, $end)) {
            return $next($request);
        }
        else {
            return response()->json([
                'message' => 'Access is allowed only between 0 AM and 5 PM.',
                'time'=> $now->format('H:i:s')
                
                
                ], 403);
        }
        



       
    }
}
