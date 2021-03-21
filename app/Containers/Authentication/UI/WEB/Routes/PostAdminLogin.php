<?php

use App\Containers\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('/login', [Controller::class, 'loginAdmin'])
    ->name('post_admin_login_form')
    ->domain('admin.' . parse_url(Config::get('app.url'))['host']);
