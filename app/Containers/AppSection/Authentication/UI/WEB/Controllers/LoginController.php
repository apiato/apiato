<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\Web\LoginAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class LoginController extends WebController
{
    public function __invoke(LoginRequest $request, LoginAction $action): RedirectResponse
    {
        return $action->run(
            $request->input('email'),
            $request->input('password'),
            $request->boolean('remember'),
        );
    }

    public function showForm(): View
    {
        return view('appSection@authentication::login');
    }
}
