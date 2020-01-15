<?php

namespace Apiato\Core\Exceptions\Handlers;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as LaravelExceptionHandler;
use Illuminate\Support\Facades\Config;
use Optimus\Heimdal\ExceptionHandler as HeimdalExceptionHandler;

/**
 * Class ExceptionsHandler
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ExceptionsHandler extends HeimdalExceptionHandler
{
    public function render($request, Exception $e)
    {
        // if the user expects json or the API forces the user to send it
        if (($request->expectsJson()) || (Config::get('apiato.requests.force-accept-header'))) {
            // return the error as json
            return parent::render($request, $e);
        }

        // neither the user nor the application wants json
        return LaravelExceptionHandler::render($request, $e);
    }
}
