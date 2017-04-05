<?php

// TODO: these needs to be separated into multiple routes files
$router->group(['domain' => 'admin.'. parse_url(\Config::get('app.url'))['host']], function ($router) {

    $router->get('/', [
        'uses' => 'Controller@showLoginPage',
    ]);

    $router->get('/login', [
        'uses' => 'Controller@showLoginPage',
    ]);

    $router->post('/login', [
        'as'   => 'admin_login',
        'uses' => 'Controller@loginAdmin',
    ]);

    $router->post('/logout', [
        'as'   => 'admin_logout',
        'uses' => 'Controller@logoutAdmin',
    ]);

    $router->get('/dashboard', [
        'uses'       => 'Controller@viewDashboardPage',
        'middleware' => [
            'auth:web'
        ],
    ]);
});
