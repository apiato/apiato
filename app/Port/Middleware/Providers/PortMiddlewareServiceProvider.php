<?php

namespace App\Port\Middleware\Providers;

use App\Port\Middleware\Loaders\MiddlewaresLoaderTrait;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as LaravelServiceProvider;

/**
 * Class PortMiddlewareServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class PortMiddlewareServiceProvider extends LaravelServiceProvider
{

    use MiddlewaresLoaderTrait;
}
