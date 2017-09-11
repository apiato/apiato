<?php

// provider callback handler
$router->any('auth/{provider}/callback', [
    'as' => 'WEB_Socialauth_callback',
    'uses' => 'Controller@handleCallbackAll',
]);

