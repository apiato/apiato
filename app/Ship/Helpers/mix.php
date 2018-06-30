<?php

// Add your helper functions here...

if (!function_exists('route')) {
    /**
     * Generate the URL to a named route with lang parameter.
     *
     * @param  array|string $name
     * @param  mixed $parameters
     * @param  bool $absolute
     * @return string
     */
    function route($name, $parameters = [], $absolute = true)
    {
        if (config('apiato.web.use_localized_routes') && !array_has($parameters, 'lang')) {
            $parameters = array_add($parameters, 'lang', app()->getLocale());
        }

        return app('url')->route($name, $parameters, $absolute);
    }
}
