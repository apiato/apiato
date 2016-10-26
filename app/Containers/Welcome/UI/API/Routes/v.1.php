<?php

// Default root route
$router->get('/', [
    'uses' => 'Controller@sayWelcome',
]);
