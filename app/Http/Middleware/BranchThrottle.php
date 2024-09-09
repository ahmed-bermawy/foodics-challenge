<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class BranchThrottle
{
    public function handle(Request $request, Closure $next)
    {
        $branchId = $request->input('branch_id');
        $key = "branch-throttle|$branchId";

        RateLimiter::for($key, function () use ($branchId) {
            return Limit::perMinute(60)->by($branchId ?: request()->ip());
        });

        if (RateLimiter::tooManyAttempts($key, 60)) {
            return response()->json(['message' => 'Too many requests'], 429);
        }

        RateLimiter::hit($key);

        return $next($request);
    }
}