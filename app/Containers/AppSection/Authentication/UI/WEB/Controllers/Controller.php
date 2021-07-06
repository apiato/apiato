<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LogoutRequest;
use App\Ship\Parents\Controllers\WebController;
use Exception;
use Illuminate\Http\RedirectResponse;

class Controller extends WebController
{
    public function showLoginPage()
    {
        return view('appSection@authentication::login');
    }

    public function logout(LogoutRequest $request)
    {
        app(WebLogoutAction::class)->run();
        return redirect('/');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $result = app(WebLoginAction::class)->run($request);
        } catch (Exception $e) {
            return redirect()->route(config('appSection-authentication.login-page-url'))->with('status', $e->getMessage());
        }

        return is_array($result)
            ? redirect()->route(config('appSection-authentication.login-page-url'))->with($result)
            : redirect()->intended();
    }
}
