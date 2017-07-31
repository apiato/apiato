<?php

$router->get('/dashboard', [
    'as'   => 'get_admin_dashboard_page',
    'uses'       => 'Controller@viewDashboardPage',
    'domain' => 'admin.'. parse_url(\Config::get('app.url'))['host'],
    'middleware' => [
        'auth:web'
    ],
]);
