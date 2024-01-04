<?php

/**
 * @apiGroup           SocialAuth
 *
 * @apiName            socialAuthRedirect
 *
 * @api                {get} /v1/auth/{provider}/redirect Auth Redirect
 *
 * @apiDescription     Redirects the user to the OAuth provider
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      none
 */

use App\Containers\AppSection\SocialAuth\UI\WEB\Controllers\AuthRedirectController;
use Illuminate\Support\Facades\Route;

Route::get('auth/{provider}/redirect', AuthRedirectController::class)
    ->name('web_socialAuth_redirect');
