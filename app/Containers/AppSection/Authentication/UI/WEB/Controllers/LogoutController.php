<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\UI\WEB\Controllers;

use App\Containers\AppSection\Authentication\Actions\WebLogoutAction;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LogoutRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Http\RedirectResponse;

class LogoutController extends WebController
{
    public function __invoke(LogoutRequest $request, WebLogoutAction $action): RedirectResponse
    {
        $action->run();

        return redirect()->action(HomePageController::class);
    }
}
