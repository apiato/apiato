<?php

namespace App\Containers\Authentication\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\Authentication\UI\WEB\Requests\LogoutRequest;
use App\Ship\Parents\Controllers\WebController;
use Exception;
use Illuminate\Http\RedirectResponse;

class Controller extends WebController
{
    public function showLoginPage()
    {
        return view('authentication::login');
    }

    public function logout(LogoutRequest $request)
    {
        Apiato::call('Authentication@WebLogoutAction');
        return redirect('/');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $result = Apiato::call('Authentication@WebLoginAction', [$request]);
        } catch (Exception $e) {
            return redirect()->route(config('authentication-container.login-page-url'))->with('status', $e->getMessage());
        }

        return is_array($result)
            ? redirect()->route(config('authentication-container.login-page-url'))->with($result)
            : redirect()->intended();
    }
}
