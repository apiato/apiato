<?php

use App\Containers\AppSection\User\UI\WEB\Controllers\IndexUsersController;
use Illuminate\Support\Facades\Route;

Route::get('/users', IndexUsersController::class)
    ->name('users.index');
