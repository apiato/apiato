<?php

namespace App\Port\Route\Providers;

use App\Port\HashId\Traits\HashIdTrait;
use App\Port\Route\Abstracts\PortRoutesServiceProviderAbstract;
use App\Port\Route\Loaders\RoutesLoaderTrait;
use Dingo\Api\Routing\Router as DingoApiRouter;
use Illuminate\Routing\Router as LaravelRouter;

/**
 * Class RoutesServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoutesServiceProvider extends PortRoutesServiceProviderAbstract
{
    use RoutesLoaderTrait;
    use HashIdTrait;

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
     * @param \Illuminate\Routing\Router $webRouter
     */
    public function map(LaravelRouter $webRouter)
    {
        $this->webRouter = $webRouter;

        $this->runRoutesAutoLoader();

        $this->runEndpointsHashedIdsDecoder();
    }


}
