<?php

use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::post('web/logout', LogoutController::class)
    ->name('post_logout');
