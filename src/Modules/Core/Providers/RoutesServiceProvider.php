<?php

namespace Hello\Modules\Core\Providers;

use Dingo\Api\Routing\Router as DingoApiRouter;
use Hello\Modules\Core\Exception\Exceptions\WrongConfigurationsException;
use Hello\Modules\Core\Providers\Traits\CoreServiceProviderTrait;
use Hello\Services\Configuration\Facade\ModulesConfig;
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
        $modulesNames = $this->getModulesNames();
        $modulesNamespace = ModulesConfig::getModulesNamespace();

        foreach ($modulesNames as $moduleName) {
            $this->registerModulesApiRoutes($moduleName, $modulesNamespace);
            $this->registerModulesWebRoutes($moduleName, $modulesNamespace);
        }

        $this->registerApplicationDefaultRoutes();
    }

    /**
     * Register the Modules API routes files
     *
     * @param $moduleName
     * @param $modulesNamespace
     */
    private function registerModulesApiRoutes($moduleName, $modulesNamespace)
    {
        foreach ($this->getModulesApiRoutes($moduleName) as $apiRoute) {

            $version = 'v' . $apiRoute['versionNumber'];

            $this->apiRouter->version($version, function ($router) use ($moduleName, $modulesNamespace, $apiRoute) {

                $router->group([
                    // Routes Namespace
                    'namespace'  => $modulesNamespace . '\\Modules\\' . $moduleName . '\\Controllers\Api',
                    // Enable: API Rate Limiting
                    'middleware' => 'api.throttle',
                    // The API limit time.
                    'limit'      => env('API_LIMIT'),
                    // The API limit expiry time.
                    'expires'    => env('API_LIMIT_EXPIRES'),
                ], function ($router) use ($moduleName, $apiRoute) {
                    require $this->validateRouteFile(
                        base_path('src/Modules/' . $moduleName . '/Routes/Api/' . $apiRoute['fileName'] . '.php')
                    );
                });

            });
        }
    }

    /**
     * Register the Modules WEB routes files
     *
     * @param $moduleName
     * @param $modulesNamespace
     */
    private function registerModulesWebRoutes($moduleName, $modulesNamespace)
    {
        foreach ($this->getModulesWebRoutes($moduleName) as $webRoute) {
            $this->webRouter->group([
                'namespace' => $modulesNamespace . '\\Modules\\' . $moduleName . '\\Controllers\Web',
            ], function ($router) use ($webRoute, $moduleName) {
                require $this->validateRouteFile(
                    base_path('src/Modules/' . $moduleName . '/Routes/Web/' . $webRoute['fileName'] . '.php')
                );
            });
        }
    }

    /**
     * The default Application Routes. When a user visit the root of the API endpoint, will access this routes.
     */
    private function registerApplicationDefaultRoutes()
    {
        $this->apiRouter->version('v1', function ($router) {

            $router->group([
                'middleware' => 'api.throttle',
                'limit'      => env('API_LIMIT'),
                'expires'    => env('API_LIMIT_EXPIRES'),
            ], function ($router) {
                // Default root route
                $router->any('/', function () {
                    return response()->json(['Welcome to ' . env('API_NAME') . '.']);
                });
                // Add more routes below
                // ...
            });

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
