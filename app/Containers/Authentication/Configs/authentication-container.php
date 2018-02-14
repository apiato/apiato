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


    'login' => [
        /*
        |--------------------------------------------------------------------------
        | Prefix
        |--------------------------------------------------------------------------
        |
        | Use this $prefix variable in order to allow for nested elements.
        | For example, if your login fields are nested in "data.attributes.name / data.attributes.email"
        | simply est the $prefix to "data.attributes." and you are good go to!
        |
        | Default: ''
        |
        */
        'prefix' => '',

        /*
        |--------------------------------------------------------------------------
        | Allowed Login Attributes
        |--------------------------------------------------------------------------
        |
        | A list of fields the user is allowed to login with.
        | Thereby, the key is the fieldname, the value (array) contains additional validation parameters that are applied!
        |
        | The order determines the order the fields are tested to login (in case multiple fields are submitted!
        |
        | Default: ['email' => ['email']
        |
        */
        'allowed_login_attributes' => [
            'email' => ['email'],
            // 'name' => [],
            // 'phone' => ['string', 'min:6', 'max:25'],
        ],
    ],

];
