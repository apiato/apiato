<?php

declare(strict_types=1);

use App\Containers\AppSection\Authentication\UI\WEB\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePageController::class);
