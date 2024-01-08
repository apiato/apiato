<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\AuthCallbackController;
use Illuminate\Support\Facades\Route;

Route::get('social-auth/callback/{provider}', AuthCallbackController::class);
