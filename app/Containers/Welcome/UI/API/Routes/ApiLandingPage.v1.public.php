<?php

// API Version root route (starts with /v{number}/)
$router->get('/', [
    'as'   => 'v1_api_landing_route',
    'uses' => 'Controller@v1ApiLandingPage',
]);
