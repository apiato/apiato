<?php

namespace App\Containers\Localization\Middlewares;

use App;
use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Config;
use Illuminate\Http\Request;

/**
 * Class LocalizationMiddleware
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class LocalizationMiddleware extends Middleware
{

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return  mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // find and validate the lang on that request
        $lang = $this->validateLanguage($this->findLanguage($request));

        // set the local language
        App::setLocale($lang);

        // get the response after the request is done
        $response = $next($request);

        // set Content Languages header in the response
        $response->headers->set('Content-Language', $lang);

        // return the response
        return $response;
    }

    /**
     * @param $lang
     *
     * @return string|Exception
     */
    private function validateLanguage($lang)
    {
        // check the languages defined is supported
        if (!array_key_exists($lang, $this->getSupportedLanguages())) {
            // respond with error
            $lang = abort(403, 'Language not supported.');
        }

        return $lang;
    }

    /**
     * @param $request
     *
     * @return  string
     */
    private function findLanguage($request)
    {
        // read the language from the request header, if the header is missed, take the default local language
        return $request->header('Content-Language') ? : Config::get('app.locale');
    }

    /**
     * @return array
     */
    private function getSupportedLanguages()
    {
        return Config::get('localization.supported_languages');
    }

}
