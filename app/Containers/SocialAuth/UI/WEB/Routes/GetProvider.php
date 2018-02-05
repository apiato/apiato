<?php

// provider login redirect (WEB)
$router->get('auth/{provider}', [
    'as' => 'web_socialauth_redirect',
    'uses' => 'Controller@redirectAll',
]);
