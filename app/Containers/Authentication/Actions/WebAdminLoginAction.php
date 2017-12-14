<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\UserNotAdminException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Transporters\Transporter;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class WebAdminLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebAdminLoginAction extends Action
{

    /**
     * @param \App\Ship\Parents\Transporters\Transporter $data
     *
     * @return  \Illuminate\Contracts\Auth\Authenticatable
     */
    public function run(Transporter $data) : Authenticatable
    {
        $user = Apiato::call('Authentication@WebLoginTask',
            [$data->email, $data->password, $data->remember_me ?? false]);

        Apiato::call('Authentication@CheckIfUserIsConfirmedTask', [], [['setUser' => [$user]]]);

        if (!$user->hasAdminRole()) {
            throw new UserNotAdminException();
        }

        return $user;
    }
}
