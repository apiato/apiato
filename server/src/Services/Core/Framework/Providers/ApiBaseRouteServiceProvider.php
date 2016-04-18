<?php

namespace Mega\Services\Core\Framework\Providers;

use Mega\Services\Core\Route\Providers\ApiRouteServiceProvider;

/**
 * Class ApiBaseRouteServiceProvider
 *
 * @type    Service Provider
 * @package Mega\Services\Core\Framework\Providers
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiBaseRouteServiceProvider extends ApiRouteServiceProvider
{

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->apiRouter->version('v1', function ($router) {

            $router->group([
                'namespace'  => 'Mega\Controllers',      // Routes Namespace
                'middleware' => 'api.throttle',          // Enable: API Rate Limiting
                'limit'      => env('API_LIMIT'),        // The API limit time.
                'expires'    => env('API_LIMIT_EXPIRES') // The API limit expiry time.
            ], function ($router) {
                $router->any('/', function () {
                    return response()->json(['Welcome to the ' . env('API_NAME') . ' API.']);
                });
            });

        });

    }
}
