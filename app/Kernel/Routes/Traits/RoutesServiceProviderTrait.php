<?php

namespace App\Kernel\Routes\Traits;

use App\Services\Configuration\Exceptions\WrongConfigurationsException;
use App\Services\Configuration\Portals\Facade\MegavelConfig;
use Dingo\Api\Routing\Router as DingoApiRouter;
use Illuminate\Routing\Router as LaravelRouter;

/**
 * Class RoutesServiceProviderTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait RoutesServiceProviderTrait
{

    /**
     * Register all the containers routes files in the framework
     */
    private function registerRoutes()
    {
        $containersNames = MegavelConfig::getContainersNames();
        $containersNamespace = MegavelConfig::getContainersNamespace();

        foreach ($containersNames as $moduleName) {
            $this->registerContainersApiRoutes($moduleName, $containersNamespace);
            $this->registerContainersWebRoutes($moduleName, $containersNamespace);
        }

        $this->registerApplicationDefaultApiRoutes();
        $this->registerApplicationDefaultWebRoutes();
    }

    /**
     * Register the Containers API routes files
     *
     * @param $moduleName
     * @param $containersNamespace
     */
    private function registerContainersApiRoutes($moduleName, $containersNamespace)
    {
        foreach (MegavelConfig::getContainersApiRoutes($moduleName) as $apiRoute) {

            $version = 'v' . $apiRoute['versionNumber'];

            $this->apiRouter->version($version,
                function (DingoApiRouter $router) use ($moduleName, $containersNamespace, $apiRoute) {

                    $router->group([
                        // Routes Namespace
                        'namespace'  => $containersNamespace . '\\Containers\\' . $moduleName . '\\Controllers\Api',
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
     * @param $containersNamespace
     */
    private function registerContainersWebRoutes($moduleName, $containersNamespace)
    {
        foreach (MegavelConfig::getContainersWebRoutes($moduleName) as $webRoute) {
            $this->webRouter->group([
                'namespace' => $containersNamespace . '\\Containers\\' . $moduleName . '\\Controllers\Web',
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
                    app_path('Kernel/Routes/default-api.php')
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
                app_path('Kernel/Routes/default-web.php')
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
                'You probably have defined some Routes files in the containers config file that does not yet exist in your module routes directory.'
            );
        }

        return $file;
    }
}
