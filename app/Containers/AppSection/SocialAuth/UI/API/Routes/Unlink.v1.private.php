<?php

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\SignupByCodeController;
use Illuminate\Support\Facades\Route;

Route::post('social-auth/unlink/{provider}', SignupByCodeController::class);
