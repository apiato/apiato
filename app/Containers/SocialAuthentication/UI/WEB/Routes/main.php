<?php

// Web callback handler
$router->any('auth/{provider}/callback', [
    'uses' => 'Controller@webAuthenticateAll',
]);

// FOR LIVE TESTING ONLY:
/**
 * Use as follow:
 * - auth/twitter/test
 * - auth/facebook/test
 * - auth/twitter/test
 * - ...
 */

$router->get('auth/{provider}/web', [
    'uses' => 'Controller@webRedirectAll',
]);
