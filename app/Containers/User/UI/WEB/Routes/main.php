<?php

$router->get('/user', [
    'as'   => 'get_user_home_page',
    'uses' => 'Controller@sayWelcome',
]);
