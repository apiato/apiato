<?php

namespace App\Ship\Middlewares\Http;

use App;
use App\Ship\Exceptions\MissingJSONHeaderException;
use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Config;
use Illuminate\Http\Request;

/**
 * Class ValidateJsonContent
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ValidateJsonContent extends Middleware
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

        $contentType = 'application/json';

        // set Content Languages header in the response | always return Content-Type application/json in the header
        $response->headers->set('Content-Type', $contentType);

        $acceptHeader = $request->header('accept');

        // if request doesn't contain in header accept = application/json. Return a warning in the response
        if (strpos($acceptHeader, $contentType) === false) {

            // if forcing users to have the accept header is enabled, then throw an exception else just send warning
            if(Config::get('apiato.requests.force-accept-header')){
                throw new MissingJSONHeaderException();
            }

            $warnCode = '199'; // https://www.iana.org/assignments/http-warn-codes/http-warn-codes.xhtml
            $warnMessage = 'Missing request header [ accept = ' . $contentType . ' ] when calling a JSON API.';
            $response->headers->set('Warning', $warnCode . ' ' . $warnMessage);
        }

        // return the response
        return $response;
    }

}
