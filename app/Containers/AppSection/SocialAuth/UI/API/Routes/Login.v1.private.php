<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('social-auth/login/{provider}', LoginController::class);

