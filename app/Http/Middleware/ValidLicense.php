<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidLicense
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->hasValidLicense()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Valid license required'
                ], 403);
            }
            return redirect()->route('payments.create')
                           ->with('error', 'You need a valid license to access this feature.');
        }

        return $next($request);
    }
}
