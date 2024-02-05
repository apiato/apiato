<?php

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Laravel\Passport\Http\Controllers\TransientTokenController;

$guard = config('passport.guard', null);

Route::group([
    'as' => 'passport.',
    'prefix' => config('passport.path', 'oauth'),
], static function () use ($guard) {
    Route::post('/token', [AccessTokenController::class, 'issueToken'])
        ->name('token')
        ->middleware(['throttle']);

    Route::middleware(['web', $guard ? 'auth:' . $guard : 'auth'])->group(function () {
        Route::post('/token/refresh', [TransientTokenController::class, 'refresh'])
            ->name('token.refresh');

        Route::get('/tokens', [AuthorizedAccessTokenController::class, 'forUser'])
            ->name('tokens.index');

        Route::delete('/tokens/{token_id}', [AuthorizedAccessTokenController::class, 'destroy'])
            ->name('tokens.destroy');

        Route::get('/clients', [ClientController::class, 'forUser'])
            ->name('clients.index');

        Route::post('/clients', [ClientController::class, 'store'])
            ->name('clients.store');

        Route::put('/clients/{client_id}', [ClientController::class, 'update'])
            ->name('clients.update');

        Route::delete('/clients/{client_id}', [ClientController::class, 'destroy'])
            ->name('clients.destroy');

        Route::get('/scopes', [ScopeController::class, 'all'])
            ->name('scopes.index');

        Route::get('/personal-access-tokens', [PersonalAccessTokenController::class, 'forUser'])
            ->name('personal.tokens.index');

        Route::post('/personal-access-tokens', [PersonalAccessTokenController::class, 'store'])
            ->name('personal.tokens.store');

        Route::delete('/personal-access-tokens/{token_id}', [PersonalAccessTokenController::class, 'destroy'])
            ->name('personal.tokens.destroy');
    });
});
