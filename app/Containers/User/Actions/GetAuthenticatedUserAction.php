<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

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
    public function run(Request $request)
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}
