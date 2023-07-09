<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class GetAuthenticatedUserAction extends ParentAction
{
    public function run(): ?Authenticatable
    {
        return Auth::user();
    }
}
