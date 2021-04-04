<?php

use App\Containers\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('docs', [Controller::class, 'showPublicDocs']);
