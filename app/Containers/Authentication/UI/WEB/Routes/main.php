<?php

$router->get('/admin/login', [
    'uses' => 'Controller@showLoginPage',
]);

$router->post('/admin/login', [
    'as'   => 'admin_login',
    'uses' => 'Controller@loginAdmin',
]);

$router->get('/admin/logout', [
    'as'   => 'admin_logout',
    'uses' => 'Controller@logoutAdmin',
]);

$router->get('/admin/dashboard', [
    'uses' => 'Controller@showDashboardPage',
    'middleware' => [
        'web.auth',
        'role.web:admin',
    ],
]);
