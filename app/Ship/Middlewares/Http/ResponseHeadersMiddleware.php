<?php

namespace App\Ship\Middlewares\Http;

use App;
use App\Ship\Exceptions\MissingJSONHeaderException;
use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Config;
use Illuminate\Http\Request;

/**
 * Class ResponseHeadersMiddleware
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ResponseHeadersMiddleware extends Middleware
{

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return  mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Validate every request to the API has accept HEADER = application/json
        // and make sure to always return Content-Type HEADER = application/json

        $contentType = 'application/json';

        $acceptHeader = $request->header('accept');

        if (strpos($acceptHeader, $contentType) === false) {
            throw new MissingJSONHeaderException();
        }

        // get the response after the request is done
        $response = $next($request);

        // set Content Languages header in the response
        $response->headers->set('Content-Type', $contentType);

        // return the response
        return $response;
    }

}
