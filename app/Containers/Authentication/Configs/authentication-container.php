<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email Confirmation
    |--------------------------------------------------------------------------
    |
    | When set to true, the user must confirm his email before being able to
    | Login, after his registration.
    |
    */

    'require_email_confirmation' => false,

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
            'admin' => [
                'id' => env('CLIENT_WEB_ADMIN_ID'),
                'secret' => env('CLIENT_WEB_ADMIN_SECRET'),
            ],
        ],
        'mobile' => [
            'admin' => [
                'id' => env('CLIENT_MOBILE_ADMIN_ID'),
                'secret' => env('CLIENT_MOBILE_ADMIN_SECRET'),
            ],
        ],

        // add your other clients here
    ],

];
