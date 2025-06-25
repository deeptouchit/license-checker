
# Deeptouchit License Checker

A simple and efficient license key verification system for Laravel applications. This package allows you to validate your license key using an external API.

## Installation

To install the `deeptouchit/license-checker` package into your Laravel project, follow these steps:

### Step 1: Install via Composer

Run the following command in your terminal:

```bash
composer require deeptouchit/license-checker
```

### Step 2: Publish Configuration File

After installing the package, you need to publish the configuration file. Run the following command:

```bash
php artisan vendor:publish --provider="Deeptouchit\LicenseChecker\LicenseServiceProvider"
```

This will publish a `license.php` file in the `config` directory.

### Step 3: Set Up Configuration

Open the `config/license.php` file and configure the following fields:

- **`api_url`**: The URL of the API that validates the license key.
- **`license_key`**: The default license key for your application.
- **`domain`**: The default domain associated with your license.
- **`phone`**: The phone number associated with the license.

Example:

```php
return [
    'api_url' => env('LICENSE_API_URL', 'https://yourdomain.com/api/verify-license'),
    'license_key' => env('LICENSE_KEY', 'your-default-license-key'),
    'domain' => env('LICENSE_DOMAIN', 'your-default-domain'),
    'phone' => env('LICENSE_PHONE', 'your-default-phone-number'),
];
```

Don't forget to add the environment variables to your `.env` file:

```env
LICENSE_API_URL=https://addmartbd.com/api/verify-license
LICENSE_KEY=your-license-key
LICENSE_DOMAIN=your-domain
LICENSE_PHONE=your-phone-number
```

## Usage

Once the package is installed and configured, you can use the `License` class to verify the license key.

### Example Usage:

In your controller or anywhere in your Laravel app, you can use the `License` class to verify the license:

```php
use Deeptouchit\LicenseChecker\License;
use GuzzleHttp\Client;

// Create an instance of the License class
$license = new License(new Client());

// Verify the license key
$result = $license->verify('your-license-key', 'your-domain', 'your-phone');

// Check the result
if ($result['success']) {
    echo 'License is valid!';
} else {
    echo 'License is invalid: ' . $result['message'];
}
```

### Parameters for `verify()` method:

- **`$licenseKey`**: The license key to be verified.
- **`$domain`**: The domain associated with the license.
- **`$phone`**: The phone number associated with the license.

### Response:

The `verify()` method returns an associative array with the following keys:

- **`success`**: A boolean indicating if the license is valid.
- **`message`**: A message that provides more details (e.g., error messages or validation info).

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---
  
### Author:

**Salzar Rahman Sabu**  
Email: [salzarrahman84@gmail.com](mailto:salzarrahman84@gmail.com)
