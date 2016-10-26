<?php

// Default root route
$router->post('/', [
    'uses' => 'Controller@welcome',
]);
