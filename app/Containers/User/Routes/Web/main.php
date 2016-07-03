<?php

$router->get('/user', [
    'uses' => 'WebController@sayWelcome',
]);
