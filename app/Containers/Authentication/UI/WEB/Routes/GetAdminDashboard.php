<?php

use App\Containers\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [Controller::class, 'viewDashboardPage'])
    ->name('get_admin_dashboard_page')
    ->domain('admin.' . parse_url(Config::get('app.url'))['host'])
    ->middleware(['auth:web']);

