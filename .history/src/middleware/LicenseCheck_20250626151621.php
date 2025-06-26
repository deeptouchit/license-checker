<?php

namespace Deeptouchit\LicenseChecker\Middleware;

use Closure;
use Illuminate\Http\Request;

class LicenseCheck
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
      
           $license = new License(new Client());

            $response = $license->verify(
                config('license.license_key'),
                config('license.domain'),
                config('license.phone'),
                config('license.product'),
                config('license.license_type')
            );

            if (isset($response['status']) && $response['status'] === 'success') {
                return $next($request);
            }

            return response()->json([
                'status' => 'error',
                'message' => $response['message'] ?? 'License verification failed.'
            ], 403);
    }
}
