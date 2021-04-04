<?php

use App\Containers\Authentication\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('login', [Controller::class, 'login'])
    ->name('login_post_form');

