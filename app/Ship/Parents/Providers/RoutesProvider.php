<?php

namespace App\Ship\Parents\Providers;

use App\Ship\Engine\Loaders\RoutesLoaderTrait;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as LaravelRouteServiceProvider;

/**
 * Class RoutesProvider.
 *
 * A.K.A app/Providers/RouteServiceProvider.php
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoutesProvider extends LaravelRouteServiceProvider
{
    use RoutesLoaderTrait;

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->runRoutesAutoLoader();

        //
    }

}
