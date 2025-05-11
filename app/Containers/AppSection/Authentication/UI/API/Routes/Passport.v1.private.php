<?php

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\ApproveAuthorizationController;
use Laravel\Passport\Http\Controllers\ApproveDeviceAuthorizationController;
use Laravel\Passport\Http\Controllers\AuthorizationController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\DenyAuthorizationController;
use Laravel\Passport\Http\Controllers\DenyDeviceAuthorizationController;
use Laravel\Passport\Http\Controllers\DeviceAuthorizationController;
use Laravel\Passport\Http\Controllers\DeviceCodeController;
use Laravel\Passport\Http\Controllers\DeviceUserCodeController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Laravel\Passport\Http\Controllers\TransientTokenController;
use Laravel\Passport\Passport;

$guard = config('passport.guard', null);

Route::group([
    'as' => 'passport.',
    'prefix' => config('passport.path', 'oauth'),
], static function () use ($guard): void {
    Route::post('/token', [AccessTokenController::class, 'issueToken'])
        ->name('token')
        ->middleware('throttle');

    Route::get('/authorize', [AuthorizationController::class, 'authorize'])
        ->name('authorizations.authorize')
        ->middleware('web');

    Route::get('/device', DeviceUserCodeController::class)
        ->name('device')
        ->middleware('web');

    Route::post('/device/code', DeviceCodeController::class)
        ->name('device.code')
        ->middleware('throttle');

    Route::middleware(['web', $guard ? 'auth:' . $guard : 'auth'])->group(static function (): void {
        Route::post('/token/refresh', [TransientTokenController::class, 'refresh'])
            ->name('token.refresh');

        Route::post('/authorize', [ApproveAuthorizationController::class, 'approve'])
            ->name('authorizations.approve');

        Route::delete('/authorize', [DenyAuthorizationController::class, 'deny'])
            ->name('authorizations.deny');

        Route::get('/device/authorize', DeviceAuthorizationController::class)
            ->name('device.authorizations.authorize');

        Route::post('/device/authorize', ApproveDeviceAuthorizationController::class)
            ->name('device.authorizations.approve');

        Route::delete('/device/authorize', DenyDeviceAuthorizationController::class)
            ->name('device.authorizations.deny');

        if (Passport::$registersJsonApiRoutes) {
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
        }
    });
});
