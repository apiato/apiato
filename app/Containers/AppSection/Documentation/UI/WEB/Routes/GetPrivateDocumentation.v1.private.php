<?php

use App\Containers\AppSection\Documentation\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

if (config('documentation-container.protect-private-docs')) {
    Route::get('docs/private', [Controller::class, 'showPrivateDocs'])
        ->name('private_docs')
        ->middleware('auth:web');
} else {
    Route::get('docs/private', [Controller::class, 'showPrivateDocs'])
        ->name('private_docs');
}
