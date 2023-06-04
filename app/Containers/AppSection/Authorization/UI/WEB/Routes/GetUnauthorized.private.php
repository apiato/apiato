<?php

use App\Containers\AppSection\Authorization\UI\WEB\Controllers\UnauthorizedController;
use Illuminate\Support\Facades\Route;

Route::get('/unauthorized', [UnauthorizedController::class, 'showUnauthorizedPage'])
    ->name('unauthorized');
