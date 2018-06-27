<?php

namespace App\Containers\Localization\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Ship\Parents\Middlewares\Middleware;
use App\Containers\Localization\Traits\LocalizationTrait;

/**
 * Class WebLocalizationMiddleware
 */
class WebLocalizationMiddleware extends Middleware
{
    use LocalizationTrait;

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return  mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // find and validate the lang on that request
        $lang = $this->validateLanguage($this->findLanguageFromUrl($request));

        // set the local language
        App::setLocale($lang);

        // get the response after the request is done
        $response = $next($request);

        // set Content Languages header in the response
        $response->headers->set('Content-Language', App::getLocale());

        // return the response
        return $response;
    }
}
