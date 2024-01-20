<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;

class LoginController extends WebController
{
    public function __invoke(LoginRequest $request, WebLoginAction $action): RedirectResponse
    {
        try {
            $action->run($request);
        } catch (\Exception $e) {
            return redirect()->route(RouteServiceProvider::LOGIN)->with('login', $e->getMessage());
        }

        return redirect()->intended();
    }
}
