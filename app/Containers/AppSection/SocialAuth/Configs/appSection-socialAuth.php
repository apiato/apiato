<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Social Authentication Redirect URLs Allow List
    |--------------------------------------------------------------------------
    |
    | Insert your allowed social authentication redirect urls here.
    */
    'allowed-redirect-urls' => [
        env('APP_URL', 'http://api.apiato.test/v1') . '/callback/facebook',
        env('APP_FULL_URL', 'http://localhost:8101') . '/callback/google',
        'https://stage.praisecharts.com',
        'https://stageapi.praisecharts.com',
        'https://stagecpanel.praisecharts.com',
        'https://pc-local.ngrok.io',
        'https://devcpanel.praisecharts.com',
        'https://devapi.praisecharts.com',
        'https://dev.praisecharts.com',
        'http://localhost',
        'http://127.0.0.1',
        'http://pc.localhost',
        'http://newapi.pc.localhost',
    ],
];
