<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LogoutRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class LogoutController extends WebController
{
    public function __construct(
        private readonly WebLogoutAction $webLogoutAction
    ) {
    }

    public function logout(LogoutRequest $request): Redirector|Application|RedirectResponse
    {
        $this->webLogoutAction->run();

        return redirect()->route(RouteServiceProvider::HOME);
    }
}
