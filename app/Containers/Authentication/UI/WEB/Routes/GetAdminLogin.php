<?php

use App\Containers\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/login', [Controller::class, 'showLoginPage'])
    ->name('get_admin_login_page')
    ->domain('admin.' . parse_url(Config::get('app.url'))['host']);
