<?php

use App\Containers\User\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/user', [Controller::class, 'sayWelcome'])
    ->name('get_user_home_page');
