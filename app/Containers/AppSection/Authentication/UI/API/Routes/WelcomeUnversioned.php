<?php

declare(strict_types=1);

use App\Containers\AppSection\Authentication\UI\API\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'unversioned']);
