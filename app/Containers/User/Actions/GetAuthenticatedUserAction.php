<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class GetAuthenticatedUserAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetAuthenticatedUserAction extends Action
{

    /**
     * @param Request $request
     *
     * @return User
     * @throws NotFoundException
     */
    public function run(Request $request): User
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}
