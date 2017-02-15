<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'  => env('USER_NAMESPACE') . User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Media Section
    |--------------------------------------------------------------------------
    |
    */

    'facebook' => [ // https://developers.facebook.com/apps
        'client_id'     => env('AUTH_FACEBOOK_CLIENT_ID'), // App ID
        'client_secret' => env('AUTH_FACEBOOK_CLIENT_SECRET'), // App Secret
        'redirect'      => env('AUTH_FACEBOOK_CLIENT_REDIRECT'),
    ],

    'twitter' => [ // https://apps.twitter.com/app
        'client_id'     => env('AUTH_TWITTER_CLIENT_ID'), // Consumer Key (API Key)
        'client_secret' => env('AUTH_TWITTER_CLIENT_SECRET'), // Consumer Secret (API Secret)
        'redirect'      => env('AUTH_TWITTER_CLIENT_REDIRECT'),
    ],

    'google' => [ // https://console.developers.google.com/apis/credentials
        'client_id'     => env('AUTH_GOOGLE_CLIENT_ID'), // Client ID
        'client_secret' => env('AUTH_GOOGLE_CLIENT_SECRET'), // Client secret
        'redirect'      => env('AUTH_GOOGLE_CLIENT_REDIRECT'),
    ],

];
