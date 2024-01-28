<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\CallbackController;
use Illuminate\Support\Facades\Route;

Route::get('social-auth/callback/{provider}', CallbackController::class);
