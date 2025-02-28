<?php

use App\Containers\AppSection\Authentication\UI\API\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'versioned']);
