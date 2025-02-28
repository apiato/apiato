<?php

namespace App\Containers\AppSection\Authentication\Actions\Web;

use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

final class LogoutAction extends ParentAction
{
    public function run(Session $session): void
    {
        Auth::guard('web')->logout();

        $session->invalidate();

        $session->regenerateToken();
    }
}
