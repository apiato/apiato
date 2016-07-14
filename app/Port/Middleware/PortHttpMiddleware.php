<?php

namespace App\Port\Middleware;

use App\Port\Middleware\Middlewares\Kernel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;
use Illuminate\Routing\Router;

/**
 * Class PortHttpMiddleware
 *
 * A.K.A (app/Http/Port.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class PortHttpMiddleware extends LaravelHttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [];

    /**
     * PortHttpMiddleware constructor.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @param \Illuminate\Routing\Router                   $router
     */
    public function __construct(Application $app, Router $router, Kernel $kernel)
    {
        $this->middleware = $kernel->applicationMiddlewares();
        $this->routeMiddleware = $kernel->routeMiddlewares();

        parent::__construct($app, $router);
    }


}
