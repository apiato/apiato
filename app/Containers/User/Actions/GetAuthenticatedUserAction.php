<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetAuthenticatedUserAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetAuthenticatedUserAction extends Action
{

    /**
     * @return  \App\Containers\User\Models\User
     * @throws  NotFoundException
     */
    public function run(): User
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }
}
