<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'   => env('USER_NAMESPACE') . User::class,
        'key'     => env('STRIPE_KEY'),
        'secret'  => env('STRIPE_SECRET'),
        'version' => '2016-07-06',
    ],

    'facebook' => [
        'client_id'     => env('AUTH_FACEBOOK_CLIENT_ID'),
        'client_secret' => env('AUTH_FACEBOOK_CLIENT_SECRET'),
        'redirect'      => env('AUTH_FACEBOOK_CLIENT_REDIRECT'),
    ],

    'twitter' => [
        'client_id'     => env('AUTH_TWITTER_CLIENT_ID'),
        'client_secret' => env('AUTH_TWITTER_CLIENT_SECRET'),
        'redirect'      => env('AUTH_TWITTER_CLIENT_REDIRECT'),
    ],

    'google' => [
        'client_id'     => env('AUTH_GOOGLE_CLIENT_ID'),
        'client_secret' => env('AUTH_GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('AUTH_GOOGLE_CLIENT_REDIRECT'),
    ],
];
