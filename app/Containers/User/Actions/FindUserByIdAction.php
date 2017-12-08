<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class FindUserByIdAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByIdAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return User
     * @throws NotFoundException
     */
    public function run(Request $request): User
    {
        $user = Apiato::call('User@FindUserByIdTask', [$request->id]);

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }

}
