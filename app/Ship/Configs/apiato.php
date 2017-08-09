<?php

return [

    'containers' => [
        /*
        |--------------------------------------------------------------------------
        | Default Namespace
        |--------------------------------------------------------------------------
        */
        'namespace'      => 'App',

        /*
        |--------------------------------------------------------------------------
        | The Login Page URL
        |--------------------------------------------------------------------------
        */
        'login-page-url' => 'login',
    ],

    /*
    |--------------------------------------------------------------------------
    | Enable / Disable Hashed ID
    |--------------------------------------------------------------------------
    */
    'hash-id'    => env('HASH_ID', true),

    'api' => [

        /*
        |--------------------------------------------------------------------------
        | API URL
        |--------------------------------------------------------------------------
        */
        'url'                     => env('API_URL', 'http://localhost'),

        /*
        |--------------------------------------------------------------------------
        | API Prefix
        |--------------------------------------------------------------------------
        */
        'prefix'                  => '/',

        /*
        |--------------------------------------------------------------------------
        | API Prefix
        |--------------------------------------------------------------------------
        */
        'enable_version_prefix'   => true,


        /*
        |--------------------------------------------------------------------------
        | Access Token Expiration
        |--------------------------------------------------------------------------
        |
        | In Minutes. Default to 1,440 minutes = 1 day
        |
        */
        'expires-in'             => env('API_TOKEN_EXPIRES', 1440),

        /*
        |--------------------------------------------------------------------------
        | Refresh Token Expiration
        |--------------------------------------------------------------------------
        |
        | In Minutes. Default to 43,200 minutes = 30 days
        |
        */
        'refresh-expires-in'     => env('API_REFRESH_TOKEN_EXPIRES', 43200),

        /*
        |--------------------------------------------------------------------------
        | Enable Disable API Debugging
        |--------------------------------------------------------------------------
        |
        | If enabled, the Error Exception trace will be injected in the JSON
        | response, and it will be logged in the default Log file.
        |
        */
        'debug'                  => env('API_DEBUG', true),

        /*
        |--------------------------------------------------------------------------
        | Enable/Disable Implicit Grant
        |--------------------------------------------------------------------------
        */
        'enabled-implicit-grant' => env('API_ENABLE_IMPLICIT_GRANT', true),

        /*
        |--------------------------------------------------------------------------
        | Rate Limit (throttle)
        |--------------------------------------------------------------------------
        |
        | Attempts per minutes.
        | `attempts` the number of attempts per `expires` in minutes.
        |
        */
        'throttle' => [
            'enabled'  => env('API_RATE_LIMIT_ENABLED', true),
            'attempts' => env('API_RATE_LIMIT_ATTEMPTS', '30'),
            'expires'  => env('API_RATE_LIMIT_EXPIRES', '1'),
        ]

    ],

    'requests' => [
        /*
        |--------------------------------------------------------------------------
        | Allow Roles to access all Routes
        |--------------------------------------------------------------------------
        |
        | Define a list of roles that do not need to go through the "hasAccess"
        | check in Requests. These roles automatically pass this check. This is
        | useful, if you want to make all routes accessible for admin users.
        |
        | Usage: ['admin', 'editor']
        | Default: []
        |
        */
        'allow-roles-to-access-all-routes' => [],
    ],

];
