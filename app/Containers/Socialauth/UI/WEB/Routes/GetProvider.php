<?php

// provider login redirect (WEB)
$router->get('auth/{provider}', [
    'as' => 'WEB_Socialauth_redirect',
    'uses' => 'Controller@redirectAll',
]);
