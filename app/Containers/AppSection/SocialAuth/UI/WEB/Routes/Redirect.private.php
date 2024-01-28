<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::get('social-auth/redirect/{provider}', RedirectController::class);
