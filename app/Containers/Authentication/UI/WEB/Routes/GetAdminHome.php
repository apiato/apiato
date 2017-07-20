<?php

$router->get('/', [
    'as'   => 'get_admin_home_page',
    'uses' => 'Controller@showLoginPage',
    'domain' => 'admin.'. parse_url(\Config::get('app.url'))['host'],
]);
