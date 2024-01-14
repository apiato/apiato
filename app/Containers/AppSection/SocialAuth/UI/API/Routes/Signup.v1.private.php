<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

// User has already logged in to the backend using email and password.
// Client only has access to client_id (not client_secret)
// Client has authorization code from the provider.
//
// This endpoint is used to link a social account to an existing account
//
// The client app gives the provider authorization code to the backend.
// The backend exchanges the code for an access token.
// The backend uses the access token to get the user's profile data from the provider.
// The backend saves the provider access token and profile data to the database.
// The backend tells the client app that the linking was successful.
Route::post('social-auth/signup/{provider}', SignupController::class);
