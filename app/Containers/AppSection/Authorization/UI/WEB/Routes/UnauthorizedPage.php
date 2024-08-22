<?php

use App\Containers\AppSection\Authorization\UI\WEB\Controllers\UnauthorizedPageController;
use Illuminate\Support\Facades\Route;

Route::get('/unauthorized', UnauthorizedPageController::class)
    ->name('unauthorized-page');
