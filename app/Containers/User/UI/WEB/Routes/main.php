<?php

Route::get('/user', [
    'uses' => 'Controller@sayWelcome',
]);
