<?php

namespace Mega\Modules\User\Providers;

use Illuminate\Routing\Router as LaravelRouter;
use Mega\Services\Core\Route\Providers\ApiRouteServiceProvider;

/**
 * Class RoutesServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoutesServiceProvider extends ApiRouteServiceProvider
{

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $webRouter
     */
    public function map(LaravelRouter $webRouter)
    {
        $this->apiRouter->version('v1', function ($router) {

            $router->group([
                'namespace'  => 'Mega\Modules\User\Controllers\Api', // Routes Namespace
                'middleware' => 'api.throttle',                      // Enable: API Rate Limiting
                'limit'      => env('API_LIMIT'),                    // The API limit time.
                'expires'    => env('API_LIMIT_EXPIRES'),             // The API limit expiry time.
            ], function ($router) {
                require app_path('../src/Modules/User/Routes/Api/v1.php');
            });

        });

        $webRouter->group([
            'namespace' => 'Mega\Modules\User\Controllers\Web',
        ], function ($router) {
            require app_path('../src/Modules/User/Routes/Web/main.php');
        });
    }
}
