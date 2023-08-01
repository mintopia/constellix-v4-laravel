<?php

namespace Tiggee\ConstellixApiLaravel\Facades;

use Illuminate\Support\Facades\Facade;
use Tiggee\ConstellixApiLaravel\Contracts\ConstellixApi as ConstellixApiContract;

class ConstellixApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ConstellixApiContract::class;
    }
}
