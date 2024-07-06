<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\IndexOAuthIdentitiesController;
use Illuminate\Support\Facades\Route;

Route::get('social-auth/identities', IndexOAuthIdentitiesController::class)
    ->middleware(['auth:api']);
