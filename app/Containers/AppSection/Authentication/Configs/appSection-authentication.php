<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Clients
    |--------------------------------------------------------------------------
    |
    | A list of clients that have access to the application.
    |
    */
    'clients' => [
        'web' => [
            'id' => env('CLIENT_WEB_ID'),
            'secret' => env('CLIENT_WEB_SECRET'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Access Token Expiration Time
    |--------------------------------------------------------------------------
    |
    | In Minutes. Default to 1,440 minutes = 1 day
    |
    */
    'tokens-expire-in' => env('API_TOKEN_EXPIRES', 1440),

    /*
    |--------------------------------------------------------------------------
    | Refresh Token Expiration Time
    |--------------------------------------------------------------------------
    |
    | In Minutes. Default to 43,200 minutes = 30 days
    |
    */
    'refresh-tokens-expire-in' => env('API_REFRESH_TOKEN_EXPIRES', 43200),
];
