<?php
// TODO: these needs to be separated into multiple routes files
Route::group(['domain' => 'admin.'. env('APP_URL')], function ($router) {

    Route::get('/', [
        'uses' => 'Controller@showLoginPage',
    ]);

    Route::get('/login', [
        'uses' => 'Controller@showLoginPage',
    ]);

    Route::post('/login', [
        'as'   => 'admin_login',
        'uses' => 'Controller@loginAdmin',
    ]);

    Route::get('/logout', [
        'as'   => 'admin_logout',
        'uses' => 'Controller@logoutAdmin',
    ]);

    Route::get('/dashboard', [
        'uses'       => 'Controller@viewDashboardPage',
        'middleware' => [
            'web.auth'
        ],
    ]);
});
