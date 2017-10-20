<?php

namespace App\Containers\Localization\Middlewares;

use App\Ship\Exceptions\UnsupportedLanguageException;
use App\Ship\Parents\Middlewares\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

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
     * @return string
     * @throws UnsupportedLanguageException
     */
    private function validateLanguage($lang)
    {
        // check the languages defined is supported
        if (!array_key_exists($lang, $this->getSupportedLanguages())) {
            // throw an exception
            throw new UnsupportedLanguageException();
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
        /*
         * read the accept-language from the request
         * if the header is missing, use the default local language
         */
        return $request->header('Accept-Language') ? : Config::get('app.locale');
    }

    /**
     * @return array
     */
    private function getSupportedLanguages()
    {
        return Config::get('localization-container.supported_languages');
    }

}
