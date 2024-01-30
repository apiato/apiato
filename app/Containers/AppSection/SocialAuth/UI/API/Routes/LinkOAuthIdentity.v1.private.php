<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\LinkOAuthIdentityController;
use Illuminate\Support\Facades\Route;

// TODO: steps are incomplete
// User has already logged in to the backend using email and password.
// This endpoint is used to link a social account to an existing account
// The backend tells the client app that the linking was successful.
Route::post('social-auth/link/{provider}', LinkOAuthIdentityController::class);
