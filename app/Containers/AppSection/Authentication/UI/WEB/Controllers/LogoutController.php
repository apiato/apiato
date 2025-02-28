<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\Web\LogoutAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LogoutRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Http\RedirectResponse;

final class LogoutController extends WebController
{
    public function __invoke(LogoutRequest $request, LogoutAction $action): RedirectResponse
    {
        $action->run($request->session());

        return redirect()->action(HomePageController::class);
    }
}
