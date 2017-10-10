<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Wepay Container
    |--------------------------------------------------------------------------
    */

    'client_id' => env('WEPAY_CLIENT_ID'),

    'client_secret' => env('WEPAY_CLIENT_SECRET'),

    'access_token' => env('WEPAY_ACCESS_TOKEN'),

    'account_id' => env('WEPAY_ACCOUNT_ID'),

    'env' => env('WEPAY_ENV', 'staging'),

    'version' => env('WEPAY_VERSION')

];
