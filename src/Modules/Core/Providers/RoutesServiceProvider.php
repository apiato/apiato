<?php

namespace Hello\Modules\Core\Providers;

use Hello\Modules\Core\Providers\Traits\MasterServiceProviderTrait;
use Hello\Modules\Core\Route\Providers\ApiRouteServiceProvider;
use Illuminate\Routing\Router as LaravelRouter;

/**
 * Class RoutesServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoutesServiceProvider extends ApiRouteServiceProvider
{

    use MasterServiceProviderTrait;

    /**
     * Laravel default Router Class
     *
     * @var \Illuminate\Routing\Router
     */
    private $webRouter;

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $webRouter
     */
    public function map(LaravelRouter $webRouter)
    {
        $this->webRouter = $webRouter;

        $modulesNames = $this->getModulesNames();
        $modulesNamespace = $this->getModulesNamespace();

        foreach ($modulesNames as $moduleName) {
            $this->registerModulesApiRoutes($moduleName, $modulesNamespace);

            $this->registerModulesWebRoutes($moduleName, $modulesNamespace);
        }
    }


    /**
     * Register the Modules API routes files
     *
     * @param $moduleName
     * @param $modulesNamespace
     */
    public function registerModulesApiRoutes($moduleName, $modulesNamespace)
    {
        $apiRoutes = $this->getModulesApiRoutes($moduleName);

        foreach ($apiRoutes as $apiRoute) {

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
                    require app_path('../src/Modules//' . $moduleName . '//Routes/Api//' . $apiRoute['fileName'] . '.php');
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
    public function registerModulesWebRoutes($moduleName, $modulesNamespace)
    {
        $webRoutes = $this->getModulesWebRoutes($moduleName);

        foreach ($webRoutes as $webRoute) {
            $this->webRouter->group([
                'namespace' => $modulesNamespace . '\\Modules\\' . $moduleName . '\\Controllers\Web',
            ], function ($router) use ($webRoute, $moduleName) {
                require app_path('../src/Modules/' . $moduleName . '/Routes/Web//' . $webRoute['fileName'] . '.php');
            });
        }

    }


}
