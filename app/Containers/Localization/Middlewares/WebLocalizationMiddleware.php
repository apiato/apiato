<?php

namespace App\Containers\Localization\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Ship\Parents\Middlewares\Middleware;

/**
 * Class WebLocalizationMiddleware
 */
class WebLocalizationMiddleware extends Middleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return  mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // get the response after the request is done
        $response = $next($request);

        // set Content Languages header in the response
        $response->headers->set('Content-Language', App::getLocale());

        // return the response
        return $response;
    }
}
