<?php

$router->post('/login', [
    'as'   => 'post_admin_login_form',
    'uses' => 'Controller@loginAdmin',
    'domain' => 'admin.'. parse_url(\Config::get('app.url'))['host'],
]);
