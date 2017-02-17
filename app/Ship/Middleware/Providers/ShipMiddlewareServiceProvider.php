<?php

namespace App\Ship\Middleware\Providers;

use App\Ship\Loader\Loaders\MiddlewaresLoaderTrait;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as LaravelServiceProvider;

/**
 * Class ShipMiddlewareServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class ShipMiddlewareServiceProvider extends LaravelServiceProvider
{

    use MiddlewaresLoaderTrait;
}
