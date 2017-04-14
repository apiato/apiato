<?php

// TODO: these needs to be separated into multiple routes files
$router->group(['domain' => 'admin.'. parse_url(\Config::get('app.url'))['host']], function ($router) {

    $router->get('/', [
        'as'   => 'get_admin_home_page',
        'uses' => 'Controller@showLoginPage',
    ]);

    $router->get('/login', [
        'as'   => 'get_admin_login_page',
        'uses' => 'Controller@showLoginPage',
    ]);

    $router->post('/login', [
        'as'   => 'post_admin_login_form',
        'uses' => 'Controller@loginAdmin',
    ]);

    $router->post('/logout', [
        'as'   => 'post_admin_logout_form',
        'uses' => 'Controller@logoutAdmin',
    ]);

    $router->get('/dashboard', [
        'as'   => 'get_admin_dashboard_page',
        'uses'       => 'Controller@viewDashboardPage',
        'middleware' => [
            'auth:web'
        ],
    ]);
});
