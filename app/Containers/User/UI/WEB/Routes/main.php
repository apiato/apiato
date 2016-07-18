<?php

$router->get('/user', [
    'uses' => 'Controller@sayWelcome',
]);
