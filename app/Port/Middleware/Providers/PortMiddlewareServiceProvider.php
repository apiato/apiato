<?php

namespace App\Port\Middleware\Providers;

use App\Port\Provider\Traits\PortServiceProviderTrait;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as LaravelServiceProvider;

/**
 * Class PortMiddlewareServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class PortMiddlewareServiceProvider extends LaravelServiceProvider
{

    use PortServiceProviderTrait;

}
