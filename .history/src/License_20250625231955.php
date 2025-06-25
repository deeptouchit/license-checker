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
     * @param string $product
     * @param string $licenseType
     * @return array
     */
    public function verify($licenseKey, $domain, $phone, $product, $licenseType)
    {
        try {
            $response = $this->client->post($this->apiUrl, [
                'form_params' => [
                    'license_key'  => $licenseKey,
                    'domain'       => $domain,
                    'phone'        => $phone,
                    'product'      => $product,  
                    'license_type' => $licenseType 
                ]
            ]);

    
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {

            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
}
