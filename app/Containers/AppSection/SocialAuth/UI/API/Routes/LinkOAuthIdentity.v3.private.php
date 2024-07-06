<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\LinkOAuthIdentityController;
use Illuminate\Support\Facades\Route;

Route::post('social-auth/link/{provider}', LinkOAuthIdentityController::class)
    ->middleware(['auth:api']);
