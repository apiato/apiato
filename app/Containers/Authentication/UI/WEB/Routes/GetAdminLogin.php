<?php

$router->get('/login', [
    'as'   => 'get_admin_login_page',
    'uses' => 'Controller@showLoginPage',
    'domain' => 'admin.'. parse_url(\Config::get('app.url'))['host'],
]);
