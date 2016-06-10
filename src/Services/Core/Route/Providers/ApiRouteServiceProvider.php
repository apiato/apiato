<?php

namespace Mega\Services\Core\Route\Providers;

use Dingo\Api\Routing\Router as DingoApiRouter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as LaravelRouteServiceProvider;
use Illuminate\Routing\Router as LaravelRouter;

/**
 * Class ApiRouteServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiRouteServiceProvider extends LaravelRouteServiceProvider
{

    /**
     * instance of the Dingo Api router.
     *
     * @var \Dingo\Api\Routing\Router
     */
    public $apiRouter;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(LaravelRouter $router)
    {
        // initializing an instance of the Dingo Api router
        $this->apiRouter = app(DingoApiRouter::class);

        parent::boot($router);
    }
}
