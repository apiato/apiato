<?php

use App\Containers\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [Controller::class, 'logout'])
    ->name('post_logout');
