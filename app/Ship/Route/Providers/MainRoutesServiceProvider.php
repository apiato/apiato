<?php

namespace App\Ship\Route\Providers;

use App\Ship\HashId\Traits\HashIdTrait;
use App\Ship\Loader\Loaders\RoutesLoaderTrait;
use App\Ship\Route\Abstracts\ShipRoutesServiceProviderAbstract;
use Dingo\Api\Routing\Router as DingoApiRouter;
use Illuminate\Routing\Router as LaravelRouter;

/**
 * Class MainRoutesServiceProvider.
 *
 * A.K.A app/Providers/RouteServiceProvider.php
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class MainRoutesServiceProvider extends ShipRoutesServiceProviderAbstract
{

    use RoutesLoaderTrait;
    use HashIdTrait;

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Instance of the Laravel default Router Class
     *
     * @var \Illuminate\Routing\Router
     */
    private $webRouter;

    /**
     * Instance of the Dingo Api router.
     *
     * @var \Dingo\Api\Routing\Router
     */
    public $apiRouter;

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        // initializing an instance of the Dingo Api router
        $this->apiRouter = app(DingoApiRouter::class);

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $webRouterParam
     */
    public function map(LaravelRouter $webRouterParam)
    {
        $this->webRouter = $webRouterParam;

        $this->runRoutesAutoLoader();

        $this->runEndpointsHashedIdsDecoder();
    }

}
