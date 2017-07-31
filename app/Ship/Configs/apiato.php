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
        'url'                    => env('API_URL', 'http://localhost'),

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
        | Rate Limit
        |--------------------------------------------------------------------------
        |
        | Attempts per minutes.
        | `throttle_attempts` the number of attempts per `throttle_expires` in
        | minutes.
        |
        */
        'throttle_attempts' => env('API_RATE_LIMIT_ATTEMPTS', '30'),
        'throttle_expires' => env('API_RATE_LIMIT_EXPIRES', '1'),
    ],

];
