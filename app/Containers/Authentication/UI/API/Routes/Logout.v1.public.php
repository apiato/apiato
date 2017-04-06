<?php

$router->post('logout', [
    'uses'  => 'Controller@logout',
    'middleware' => [
        'auth:api',
    ],
]);

