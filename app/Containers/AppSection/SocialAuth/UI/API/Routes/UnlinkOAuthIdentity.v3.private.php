<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\UnlinkOAuthIdentityController;
use Illuminate\Support\Facades\Route;

Route::post('social-auth/unlink/{provider}', UnlinkOAuthIdentityController::class)
    ->middleware(['auth:api']);
