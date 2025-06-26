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
        if (!config('license.license_key')) {
            return redirect('license-error');  
        }

        return $next($request);
    }
}
