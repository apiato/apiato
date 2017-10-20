<?php

namespace App\Containers\Localization\Middlewares;

use App\Containers\Localization\Exceptions\UnsupportedLanguageException;
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
     * @param $request_languages
     *
     * @return string
     * @throws UnsupportedLanguageException
     */
    private function validateLanguage($request_languages)
    {
        /*
         * be sure to check $lang of the format "de-DE,de;q=0.8,en-US;q=0.6,en;q=0.4"
         * this means:
         *  1) give me de-DE if it is available
         *  2) otherwise, give me de
         *  3) otherwise, give me en-US
         *  4) if all fails, give me en
        */

        // split it up by ","
        $languages = explode(',', $request_languages);

        $supported_languages = $this->getSupportedLanguages();

        foreach ($languages as $language)
        {
            // split it up by ";"
            $locale = explode(';', $language);

            $current_locale = $locale[0];

            // now check, if this locale is "supported"
            if ( array_key_exists($current_locale, $supported_languages))
            {
                return $current_locale;
            }
        }

        // we have not found any language that is supported
        throw new UnsupportedLanguageException();
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
