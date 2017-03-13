<?php

// Default root route
Route::get('/', [
    'uses' => 'Controller@sayWelcome',
]);
