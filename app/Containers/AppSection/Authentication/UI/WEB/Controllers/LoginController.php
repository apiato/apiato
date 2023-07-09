<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLoginAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends WebController
{
    public function __construct(
        private readonly WebLoginAction $webLoginAction
    ) {
    }

    public function showLoginPage(): Factory|View|Application
    {
        return view('appSection@authentication::login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $this->webLoginAction->run($request);
        } catch (\Exception $e) {
            return redirect()->route(RouteServiceProvider::LOGIN)->with('login', $e->getMessage());
        }

        return redirect()->intended();
    }
}
