<?php

return [
    /*
    |--------------------------------------------------------------------------
    | License API URL
    |--------------------------------------------------------------------------
    |
    | This is the API URL to verify the license key.
    |
    */
    'api_url' => env('LICENSE_API_URL', 'https://addmartbd.com/api/verify-license'),

    /*
    |--------------------------------------------------------------------------
    | License Key
    |--------------------------------------------------------------------------
    |
    | You can specify a default license key here, or keep it dynamic.
    |
    */
    'license_key' => env('LICENSE_KEY', 'your-default-license-key'),

    /*
    |--------------------------------------------------------------------------
    | Default Domain
    |--------------------------------------------------------------------------
    |
    | The domain to be used for license verification.
    |
    */
    'domain' => env('LICENSE_DOMAIN', 'your-default-domain'),

    /*
    |--------------------------------------------------------------------------
    | Phone Number
    |--------------------------------------------------------------------------
    |
    | The phone number to be used for license verification.
    |
    */
    'phone' => env('LICENSE_PHONE', 'your-default-phone-number'),
];
