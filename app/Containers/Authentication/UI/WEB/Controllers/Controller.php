<?php

namespace App\Containers\Authentication\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Controllers\WebController;
use Exception;

class Controller extends WebController
{
    public function showLoginPage()
    {
        return view('authentication::login');
    }

    public function login(LoginRequest $request)
    {
        try {
            $result = Apiato::call('Authentication@WebLoginAction', [$request]);
        } catch (Exception $e) {
            return redirect(config('authentication-container.login-page-url'))->with('status', $e->getMessage());
        }

        return is_array($result)
            ? redirect(config('authentication-container.login-page-url'))->with($result)
            : redirect()->intended();
    }
}
