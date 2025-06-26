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
        // আপনার লাইসেন্স চেক করার লজিক এখানে থাকবে
        if (!config('license.license_key')) {
            return redirect('license-error');  // লাইসেন্স না থাকলে রিডাইরেক্ট
        }

        return $next($request);
    }
}
