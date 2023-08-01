<?php

namespace Tiggee\ConstellixApiLaravel;

use Constellix\Client\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Psr\Log\LoggerInterface;
use Tiggee\ConstellixApiLaravel\Contracts\ConstellixApi;

class ServiceProvider extends LaravelServiceProvider
{
    protected function boot(): void
    {
        $this->publishes([
            /** @phpstan-ignore-next-line */
            __DIR__ . '/../config/constellix.php' => config_path('constellix.php'),
        ]);
    }

    public function register()
    {
        $this->app->bind(ConstellixApi::class, function (Application $app) {
            return new Client(
                $app->make(ClientInterface::class),
                new IlluminatePaginatorFactory(),
                $app->make(LoggerInterface::class)
            );
        });
    }
}
