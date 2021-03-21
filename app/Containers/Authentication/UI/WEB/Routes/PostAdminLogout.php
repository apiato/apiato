<?php

use App\Containers\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [Controller::class, 'logoutAdmin'])
    ->name('post_admin_logout_form')
    ->domain('admin.' . parse_url(Config::get('app.url'))['host']);
