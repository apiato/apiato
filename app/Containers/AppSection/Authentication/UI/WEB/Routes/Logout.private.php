<?php

use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::post('web/logout', [LogoutController::class, 'logout'])
    ->name('post_logout');
