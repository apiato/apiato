<?php

$router->get('/user', [
    'uses' => 'WelcomeUserController@handle',
]);
