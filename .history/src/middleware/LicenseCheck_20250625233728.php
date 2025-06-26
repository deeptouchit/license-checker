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
        $result = $license->verify(
            config('license.license_key'),
            config('license.domain'),
            config('license.phone')
            config('license.product'),
            config('license.license_type')
        );


        return $next($request);
    }
}
