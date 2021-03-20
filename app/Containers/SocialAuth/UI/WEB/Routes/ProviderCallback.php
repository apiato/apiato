<?php

use App\Containers\SocialAuth\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

// provider callback handler
Route::post('auth/{provider}/callback', [Controller::class, 'handleCallbackAll'])->name('web_socialAuth_callback');
