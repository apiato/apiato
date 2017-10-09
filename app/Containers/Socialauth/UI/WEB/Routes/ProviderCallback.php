<?php

// provider callback handler
$router->any('auth/{provider}/callback', [
    'as' => 'web_socialauth_callback',
    'uses' => 'Controller@handleCallbackAll',
]);

