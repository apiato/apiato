<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class FindUserByIdAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByIdAction extends Action
{

    /**
     * @param $userId
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($userId): User
    {
        $user = Apiato::call('User@FindUserByIdTask', [$userId]);

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }

}
