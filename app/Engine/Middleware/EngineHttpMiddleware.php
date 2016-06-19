<?php

namespace App\Engine\Middleware;

use App\Services\Middlewares\Kernel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Kernel as LaravelHttpKernel;
use Illuminate\Routing\Router;

/**
 * Class EngineHttpMiddleware
 *
 * A.K.A (app/Http/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class EngineHttpMiddleware extends LaravelHttpKernel
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
     * EngineHttpMiddleware constructor.
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
