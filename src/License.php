<?php

namespace Deeptouchit\LicenseChecker;

use GuzzleHttp\Client;

class License
{
    protected $client;
    protected $apiUrl;

    /**
     * Constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiUrl = config('license.api_url'); // লাইসেন্স API URL কনফিগ থেকে আসবে
    }

    /**
     * Verify the license key.
     *
     * @param string $licenseKey
     * @param string $domain
     * @param string $phone
     * @return array
     */
    public function verify($licenseKey, $domain, $phone)
    {
        try {
            $response = $this->client->post($this->apiUrl, [
                'form_params' => [
                    'license_key' => $licenseKey,
                    'domain' => $domain,
                    'phone' => $phone,
                ]
            ]);

            // JSON রেসপন্স পার্স করা
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            // যদি কোন ত্রুটি ঘটে তবে তা লগ করুন
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
}
