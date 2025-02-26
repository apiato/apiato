<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;

final class ApiLogoutAction extends ParentAction
{
    public function run(User|null $user): void
    {
        $user?->token()?->revoke();
    }
}
