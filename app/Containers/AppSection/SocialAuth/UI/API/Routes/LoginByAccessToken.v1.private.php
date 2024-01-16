<?php

// https://developers.google.com/identity/protocols/oauth2/javascript-implicit-flow
// It expects a GET request with a query string
// containing the user's access token which was received from the social provider
// If user is not logged in, we throw an error (update: why?!)

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\LoginByAccessTokenController;
use Illuminate\Support\Facades\Route;

Route::post('social-auth/login/token/{provider}', LoginByAccessTokenController::class);
