# Constellix API Laravel Integration

## Introduction

This library allows easy integration of the Constellix V4 API into a Laravel application. It adds a Service Provider, Facade and exposes LengthAwarePaginators for resources.

## Installation

Include the package through composer:

```bash
composer require tiggee/constellix-v4-laravel
```

The package will be downloaded and auto-discovered by laravel. You can now publish the config file using:

```bash
php artisan vendor:publish --provider="Tiggee\ConstellixApiLaravel\ServiceProvider"
```

The next steps will be to configure the API client and use it.

### Without Auto-Discovery

If you are not using auto-discovery for packages, you can add the service provider to the providers array in `config/app.php`:

```php
Tiggee\ConstellixApiLaravel\ServiceProvider::class,
```

## Configuration

The configuration file that is published is configured to use environment variables for the configuration:

```dotenv
CONSTELLIX_API_SECRET=Your API Secret Key
CONSTELLIX_API_KEY=Your API Key
```

You can also specify `CONSTELLIX_API_ENDPOINT` if you want to override the endpoint used for the API, but this should be left undefined by default.

## Usage

The API's contract is registered as an interface, so can be typehinted in constructors. There is also a Facade `ConstellixApi` that can be used.

### Type Hinting
```php
<?php
namespace App\Http\Controllers;

use Constellix\Client\Interfaces\ConstellixApiClient;

class HomeController extends Controller {

    public function index(ConstellixApiClient $api): void
    {
        $domain = $api->domains->get(1234);
    }
}
```

### Service Container Resolution
```php
<?php
use Constellix\Client\Interfaces\ConstellixApiClient;
$api = resolve(ConstellixApiClient::class);
$domain = $api->domains->get(1234);
```

## API Usage

For usage of the API client, please [read the documentation](https://github.com/Constellix/constellix-php-sdk) supplied for the client on GitHub.

## Support

This is an open-source project and if you have any problems with it, please raise issues in this project and we will look at them. If you have any fixes or improvements, please open a pull request and we'll be happy to review it and include it.

## Development

We use PHPStan with a level of 8 and follow PSR-12 coding standards, enforced with PHP Code Sniffer. Testing is using PHP Unit.

The scripts have been added to composer.json.
