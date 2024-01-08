<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\AuthRedirectController;
use Illuminate\Support\Facades\Route;

Route::get('social-auth/redirect/{provider}', AuthRedirectController::class);
