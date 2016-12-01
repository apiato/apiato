<?php

// Confirming user email address URL
$router->get('/users/{id}/email/confirmation/{code}', [
    'uses' => 'Controller@confirmUserEmail',
]);
