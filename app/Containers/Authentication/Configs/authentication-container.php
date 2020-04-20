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

    /*
    |--------------------------------------------------------------------------
    | Login With Custom Field
    |--------------------------------------------------------------------------
    |
    | This allows you to chose which field you want to use for passport auth.
    |
    */

    'login' => [

        /*
        |--------------------------------------------------------------------------
        | Allowed Login Attributes
        |--------------------------------------------------------------------------
        |
        | A list of fields the user can login with.
        | The key is the field name. The value contains validation rules of the key.
        |
        | The order determines the order the fields are tested to login (in case multiple fields are submitted!
        |
        | Example: 'phone' => ['string', 'min:6', 'max:25'],
        |
        */

        'attributes' => [
            'email' => ['email'],
        ],

        /*
        |--------------------------------------------------------------------------
        | Prefix
        |--------------------------------------------------------------------------
        |
        | Use this $prefix variable in order to allow for nested elements.
        | For example, if your login fields are nested in "data.attributes.name / data.attributes.email"
        | simply set the $prefix to "data.attributes."
        |
        */

        'prefix' => '',

    ],

];
