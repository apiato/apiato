<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        // 'redirect' => 'is the same redirect_url that is sent to google to get the authorization code',
        // Test with Google playground (getting the authorization code), acting as a client e.g., a web app
        // 'redirect' => 'https://developers.google.com/oauthplayground',
        // The webpage that the user will be redirected to after getting the authorization code (usually handled by the client e.g., a web app)
        // Then the client will use the authorization code to get the access token (by sending a post request code+sameRedirectUrl to the API)
        // Then we return the access token to the client
        'redirect' => 'http://example.com/social-auth/callback/google',
        // Test with API (Monolith)
        // 'redirect' => 'http://api.example.com/v1/social-auth/callback/google',
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        // TODO: Test Facebook login
         'redirect' => 'https://developers.google.com/oauthplayground',
//        'redirect' => 'https://developers.facebook.com/tools/explorer',
//        'redirect' => 'http://localhost/social-auth/callback/facebook',
    ],
];
