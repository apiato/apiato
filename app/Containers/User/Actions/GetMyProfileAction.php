<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\UserNotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetMyProfileAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetMyProfileAction extends Action
{
    public function run(Request $request)
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
