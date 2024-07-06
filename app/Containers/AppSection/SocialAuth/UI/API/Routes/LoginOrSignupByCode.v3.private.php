<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\LoginOrSignupByCodeController;
use Illuminate\Support\Facades\Route;

Route::post('social-auth/login-or-signup/{provider}', LoginOrSignupByCodeController::class);
