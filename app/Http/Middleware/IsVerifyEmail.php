<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
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
        if (env('local')) {
            DB::enableQueryLog();
        }
        return $next($request);
    
        if (!Auth::guard('mobile-api')->user()->email_verified_at) {
            $response = [
                'success' => false,
                'message' => 'Email belum terverifikasi',
            ];
            return response()->json($response, 200);
        }

        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Here you can either Log it, DD, etc.

        Log::info(DB::getQueryLog());
    }
}
