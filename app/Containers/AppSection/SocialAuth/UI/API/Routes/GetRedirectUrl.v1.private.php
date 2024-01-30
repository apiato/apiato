<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\SignupByCodeController;
use Illuminate\Support\Facades\Route;

// TODO: Generate a redirect URL for the frontend to redirect the user to the social provider
// Do we need to generate a redirect URL for the frontend to redirect the user to the social provider?
// Also, frontend should provide a callback URL to redirect the user back to the frontend.
// Something like how we do it in for the forgot/reset password feature.
// Route::post('social-auth/identities', SignupByCodeController::class);
