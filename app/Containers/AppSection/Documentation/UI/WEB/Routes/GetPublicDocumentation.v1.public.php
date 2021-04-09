<?php

use App\Containers\AppSection\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('docs', [Controller::class, 'showPublicDocs'])
    ->name('public_docs');
