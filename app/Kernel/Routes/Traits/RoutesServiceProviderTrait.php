<?php

namespace App\Kernel\Routes\Traits;

use App\Kernel\Configuration\Exceptions\WrongConfigurationsException;
use App\Kernel\Configuration\Portals\Facade\MegavelConfig;
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

        foreach ($containersNames as $containerName) {
            $this->registerContainersApiRoutes($containerName, $containersNamespace);
            $this->registerContainersWebRoutes($containerName, $containersNamespace);
        }

        $this->registerApplicationDefaultApiRoutes();
        $this->registerApplicationDefaultWebRoutes();
    }

    /**
     * Register the Containers API routes files
     *
     * @param $containerName
     * @param $containersNamespace
     */
    private function registerContainersApiRoutes($containerName, $containersNamespace)
    {
        foreach (MegavelConfig::getContainersApiRoutes($containerName) as $apiRoute) {

            $version = 'v' . $apiRoute['versionNumber'];

            $this->apiRouter->version($version,
                function (DingoApiRouter $router) use ($containerName, $containersNamespace, $apiRoute) {

                    $router->group([
                        // Routes Namespace
                        'namespace'  => $containersNamespace . '\\Containers\\' . $containerName . '\\Controllers\Api',
                        // Enable: API Rate Limiting
                        'middleware' => 'api.throttle',
                        // The API limit time.
                        'limit'      => env('API_LIMIT'),
                        // The API limit expiry time.
                        'expires'    => env('API_LIMIT_EXPIRES'),
                    ], function ($router) use ($containerName, $apiRoute) {
                        require $this->validateRouteFile(
                            app_path('Containers/' . $containerName . '/Routes/Api/' . $apiRoute['fileName'] . '.php')
                        );
                    });

                });
        }
    }

    /**
     * Register the Containers WEB routes files
     *
     * @param $containerName
     * @param $containersNamespace
     */
    private function registerContainersWebRoutes($containerName, $containersNamespace)
    {
        foreach (MegavelConfig::getContainersWebRoutes($containerName) as $webRoute) {
            $this->webRouter->group([
                'namespace' => $containersNamespace . '\\Containers\\' . $containerName . '\\Controllers\Web',
            ], function (LaravelRouter $router) use ($webRoute, $containerName) {
                require $this->validateRouteFile(
                    app_path('/Containers/' . $containerName . '/Routes/Web/' . $webRoute['fileName'] . '.php')
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
                'You probably have defined some Routes files in the containers config file that does not yet exist in your container routes directory.'
            );
        }

        return $file;
    }
}
