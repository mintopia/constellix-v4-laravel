<?php

namespace Tiggee\ConstellixApiLaravel;

use Constellix\Client\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use Tiggee\ConstellixApiLaravel\Contracts\ConstellixApi;

class ServiceProvider extends LaravelServiceProvider
{
    protected function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/constellix.php' => config_path('constellix.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind(abstract: ConstellixApi::class, concrete: function (Application $app) {
            $client = new Client(
                client: $app->make(ClientInterface::class),
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
