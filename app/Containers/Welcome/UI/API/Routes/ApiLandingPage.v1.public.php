<?php

use App\Containers\Welcome\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

// http://api.apiato.test/v1
Route::get('/', [Controller::class, 'v1ApiLandingPage'])
    ->name('v1_api_landing_route');
