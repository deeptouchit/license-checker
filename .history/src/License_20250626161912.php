<?php

namespace Deeptouchit\LicenseChecker;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

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

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $errorBody = $e->getResponse()->getBody()->getContents();
                $decoded = json_decode($errorBody, true);
                return [
                    'status' => 'error',
                    'message' => $decoded['message'] ?? 'License server returned an error.'
                ];
            }

            return [
                'status' => 'error',
                'message' => 'Request failed: ' . $e->getMessage()
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Unexpected error: ' . $e->getMessage()
            ];
        }
    }
}
