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
        | Force Valid Request Include Parameters
        |--------------------------------------------------------------------------
        |
        | By default, users can request to include additional resources into the
        | response by using the ?include=... query parameter. The requested top-level
        | resource also responds with all available includes. However, the user may
        | still request an invalid (i.e., not available) include parameter. This flag
        | determines, how to proceed in such a case:
        | When set to true, a PHP Exception will be thrown (default)
        | When set to false, this invalid include will be skipped
        |
        */
        'force-valid-includes' => true,

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
        'use-etag' => true,
    ],

];
