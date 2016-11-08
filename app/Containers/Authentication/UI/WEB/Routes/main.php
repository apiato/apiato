<?php
$router->group(['domain' => 'admin.'. env('APP_URL')], function ($router) {

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

    $router->get('/logout', [
        'as'   => 'admin_logout',
        'uses' => 'Controller@logoutAdmin',
    ]);

    $router->get('/dashboard', [
        'uses'       => 'Controller@showDashboardPage',
        'middleware' => [
            'web.auth',
            'role.web:admin',
        ],
    ]);
});
