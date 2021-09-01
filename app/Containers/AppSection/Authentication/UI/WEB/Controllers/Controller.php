<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LogoutRequest;
use App\Ship\Parents\Controllers\WebController;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class Controller extends WebController
{
    public function showLoginPage(): Factory|View|Application
    {
        return view('appSection@authentication::login');
    }

    public function logout(LogoutRequest $request): Redirector|Application|RedirectResponse
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
