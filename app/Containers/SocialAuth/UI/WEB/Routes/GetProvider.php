<?php

use App\Containers\SocialAuth\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

// provider login redirect (WEB)
Route::post('auth/{provider}', [Controller::class, 'redirectAll'])->name('web_socialAuth_redirect');

