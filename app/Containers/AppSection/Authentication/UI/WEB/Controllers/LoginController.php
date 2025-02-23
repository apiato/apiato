<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Http\RedirectResponse;

final class LoginController extends WebController
{
    public function __invoke(LoginRequest $request, WebLoginAction $action): RedirectResponse
    {
        return $action->run($request->sanitize([
            ...array_keys(config('appSection-authentication.login.fields', ['email' => []])),
            'password',
            'remember' => false,
        ]));
    }
}
