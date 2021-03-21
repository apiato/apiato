<?php

use App\Containers\Welcome\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'sayWelcome'])
    ->name('get_main_home_page');
