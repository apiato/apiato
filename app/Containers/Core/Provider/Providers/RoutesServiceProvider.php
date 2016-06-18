<?php

namespace App\Containers\Core\Provider\Providers;

use App\Containers\Core\Provider\Traits\CoreServiceProviderTrait;
use App\Services\Configuration\Exceptions\WrongConfigurationsException;
use App\Services\Configuration\Portals\Facade\ContainersConfig;
use Dingo\Api\Routing\Router as DingoApiRouter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as LaravelRouteServiceProvider;
use Illuminate\Routing\Router as LaravelRouter;

/**
 * Class RoutesServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoutesServiceProvider extends LaravelRouteServiceProvider
{

    use CoreServiceProviderTrait;

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
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(LaravelRouter $router)
    {
        // initializing an instance of the Dingo Api router
        $this->apiRouter = app(DingoApiRouter::class);

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $webRouter
     */
    public function map(LaravelRouter $webRouter)
    {
        $this->webRouter = $webRouter;

        $this->registerRoutes();
    }

    /**
     * Register all the modules routes files in the framework
     */
    private function registerRoutes()
    {
        $modulesNames = ContainersConfig::getContainersNames();
        $modulesNamespace = ContainersConfig::getContainersNamespace();

        foreach ($modulesNames as $moduleName) {
            $this->registerContainersApiRoutes($moduleName, $modulesNamespace);
            $this->registerContainersWebRoutes($moduleName, $modulesNamespace);
        }

        $this->registerApplicationDefaultApiRoutes();
        $this->registerApplicationDefaultWebRoutes();
    }

    /**
     * Register the Containers API routes files
     *
     * @param $moduleName
     * @param $modulesNamespace
     */
    private function registerContainersApiRoutes($moduleName, $modulesNamespace)
    {
        foreach (ContainersConfig::getContainersApiRoutes($moduleName) as $apiRoute) {

            $version = 'v' . $apiRoute['versionNumber'];

            $this->apiRouter->version($version,
                function (DingoApiRouter $router) use ($moduleName, $modulesNamespace, $apiRoute) {

                    $router->group([
                        // Routes Namespace
                        'namespace'  => $modulesNamespace . '\\Containers\\' . $moduleName . '\\Controllers\Api',
                        // Enable: API Rate Limiting
                        'middleware' => 'api.throttle',
                        // The API limit time.
                        'limit'      => env('API_LIMIT'),
                        // The API limit expiry time.
                        'expires'    => env('API_LIMIT_EXPIRES'),
                    ], function ($router) use ($moduleName, $apiRoute) {
                        require $this->validateRouteFile(
                            app_path('Containers/' . $moduleName . '/Routes/Api/' . $apiRoute['fileName'] . '.php')
                        );
                    });

                });
        }
    }

    /**
     * Register the Containers WEB routes files
     *
     * @param $moduleName
     * @param $modulesNamespace
     */
    private function registerContainersWebRoutes($moduleName, $modulesNamespace)
    {
        foreach (ContainersConfig::getContainersWebRoutes($moduleName) as $webRoute) {
            $this->webRouter->group([
                'namespace' => $modulesNamespace . '\\Containers\\' . $moduleName . '\\Controllers\Web',
            ], function (LaravelRouter $router) use ($webRoute, $moduleName) {
                require $this->validateRouteFile(
                    app_path('/Containers/' . $moduleName . '/Routes/Web/' . $webRoute['fileName'] . '.php')
                );
            });
        }
    }

    /**
     * The default Application API Routes. When a user visit the root of the API endpoint, will access these routes.
     * This will be overwritten by the Containers if defined there.
     */
    private function registerApplicationDefaultApiRoutes()
    {
        $this->apiRouter->version('v1', function ($router) {

            $router->group([
                'middleware' => 'api.throttle',
                'limit'      => env('API_LIMIT'),
                'expires'    => env('API_LIMIT_EXPIRES'),
            ], function (DingoApiRouter $router) {
                require $this->validateRouteFile(
                    app_path('Containers/Core/Routes/default-api.php')
                );
            });

        });
    }

    /**
     * The default Application Web Routes. When a user visit the root of the web, will access these routes.
     * This will be overwritten by the Containers if defined there.
     */
    private function registerApplicationDefaultWebRoutes()
    {
        $this->webRouter->group([], function (LaravelRouter $router) {
            require $this->validateRouteFile(
                app_path('Containers/Core/Routes/default-web.php')
            );
        });
    }


    /**
     * Check route file exist
     *
     * @param $file
     *
     * @return  mixed
     */
    private function validateRouteFile($file)
    {
        if (!file_exists($file)) {
            throw new WrongConfigurationsException(
                'You probably have defined some Routes files in the modules config file that does not yet exist in your module routes directory.'
            );
        }

        return $file;
    }

}
