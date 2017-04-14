<?php

// API Root route
$router->get('/', [
    'as'   => 'apis_root_page',
    'uses' => 'Controller@apiRoot',
]);
