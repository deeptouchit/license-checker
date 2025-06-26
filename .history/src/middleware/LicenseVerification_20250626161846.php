<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Deeptouchit\LicenseChecker\License;
use GuzzleHttp\Client;

class LicenseVerification
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

        return redirect()->route('admin.license.index')->with([
            'message'    => $response['message'] ?? 'License verification failed.',
            'alert-type' => 'error',
        ]);
    }
}
