<?php

declare(strict_types=1);

use App\Containers\AppSection\Authentication\UI\WEB\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class)
    ->name('login');
