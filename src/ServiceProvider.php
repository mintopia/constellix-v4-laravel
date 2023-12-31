<?php

namespace Tiggee\ConstellixApiLaravel;

use Constellix\Client\Client;
use Constellix\Client\Interfaces\ConstellixApiClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Psr\Log\LoggerInterface;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/constellix.php' => config_path('constellix.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind(abstract: ConstellixApiClient::class, concrete: function (Application $app) {
            $client = new Client(
                client: new \GuzzleHttp\Client(),
                paginatorFactory: new IlluminatePaginatorFactory(),
                logger: $app->make(LoggerInterface::class)
            );
            $client->setEndpoint(config('constellix.endpoint'));
            $client->setApiKey(config('constellix.api_key'));
            $client->setSecretKey(config('constellix.secret_key'));
            return $client;
        });
    }
}
