<?php

use App\Ship\Apps\Web;

return [
    /*
    |--------------------------------------------------------------------------
    | App Defaults
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'app' => 'web',
    ],

    /*
    |--------------------------------------------------------------------------
    | Enable / Disable Hashed ID
    |--------------------------------------------------------------------------
    */
    'hash-id' => env('HASH_ID', true),

    'api' => [
        /*
        |--------------------------------------------------------------------------
        | API URL
        |--------------------------------------------------------------------------
        */
        'url' => env('API_URL', 'http://localhost'),

        /*
        |--------------------------------------------------------------------------
        | Rate Limiting
        |--------------------------------------------------------------------------
        |
        | Attempts per minutes.
        | `attempts` is the number of attempts per `expires` in minutes.
        |
        */
        'rate-limiter' => [
            'name' => env('GLOBAL_API_RATE_LIMITER_NAME', 'api'),
            'enabled' => env('GLOBAL_API_RATE_LIMITER_ENABLED', true),
            'attempts' => env('GLOBAL_API_RATE_LIMITER_ATTEMPTS_PER_MIN', '30'),
            'expires' => env('GLOBAL_API_RATE_LIMITER_EXPIRES_IN_MIN', '1'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Apps
    |--------------------------------------------------------------------------
    |
    | A list of apps that have access to the application.
    |
    | This is useful when you have multiple web apps (like an admin panel, frontend, etc...), and you want to
    | generate different URLs for each app.
    | For example, for the password reset and email verification links.
    |
    */
    'apps' => [
        'web' => [
            'class' => Web::class,
            'url' => env('FRONTEND_URL', env('APP_URL', 'http://localhost:3000')),
        ],
    ],

    'requests' => [
        /*
        |--------------------------------------------------------------------------
        | Force Request Header to Contain header
        |--------------------------------------------------------------------------
        |
        | By default, users can send request without defining the accept header and
        | setting it to [ accept = application/json ].
        | To force the users to define that header, set this to true.
        | When set to true, a PHP exception will be thrown preventing users from access
        | When set to false, the header will contain a warning message.
        |
        */
        'force-accept-header' => false,

        /*
        |--------------------------------------------------------------------------
        | Use ETags
        |--------------------------------------------------------------------------
        |
        | This option appends an "ETag" HTTP Header to the Response. This ETag is a
        | calculated hash of the content to be delivered.
        | Clients can add an "If-None-Match" HTTP Header to the Request and submit
        | an (old) ETag. These ETags are validated. If they match (are the same),
        | an empty BODY with HTTP STATUS 304 (not modified) is returned!
        |
        */
        'use-etag' => false,
    ],
];
