<?php

// provider login redirect (WEB)
Route::get('auth/{provider}', [
    'uses' => 'Controller@redirectAll',
]);

// provider callback handler
Route::any('auth/{provider}/callback', [
    'uses' => 'Controller@handleCallbackAll',
]);

