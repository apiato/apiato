<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

// Useless for now. I have no idea how this can be used. Maybe for a mobile app?
Route::get('social-auth/redirect/{provider}', RedirectController::class);
