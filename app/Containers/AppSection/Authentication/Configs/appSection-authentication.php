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
        'mobile' => [
            'id' => env('CLIENT_MOBILE_ID'),
            'secret' => env('CLIENT_MOBILE_SECRET'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Login With Custom Field
    |--------------------------------------------------------------------------
    |
    | This allows you to choose which field you want to use for passport auth.
    |
    */

    'login' => [
        /*
        |--------------------------------------------------------------------------
        | Allowed Login Fields
        |--------------------------------------------------------------------------
        |
        | A list of fields the user can log in with.
        | The key is the field name. The value contains validation rules of the key.
        |
        | The order determines the order the fields are tested to log in (in case multiple fields are submitted!)
        |
        | Example: 'phone' => ['string', 'min:6', 'max:25'],
        |
        */

        'fields' => [
            'email' => ['email'],
        ],

        /*
        |--------------------------------------------------------------------------
        | Prefix
        |--------------------------------------------------------------------------
        |
        | Use this $prefix variable to allow for nested elements.
        | For example, if your login fields are nested in "data.field.name / data.field.email"
        | simply set the $prefix to "data.fields."
        |
        */

        'prefix' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Reset Password URLs
    |--------------------------------------------------------------------------
    |
    | Insert your allowed reset password urls which user can request to be injected into the email.
    |
    */
    'allowed-reset-password-urls' => [
        env('FRONTEND_URL', 'http://localhost:3000') . '/password/reset',
    ],
];
