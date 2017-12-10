<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Transporters\Transporter;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class WebLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginAction extends Action
{

    /**
     * @param \App\Ship\Parents\Transporters\Transporter $data
     *
     * @return  \Illuminate\Contracts\Auth\Authenticatable
     */
    public function run(Transporter $data): Authenticatable
    {
        $user = Apiato::call('Authentication@WebLoginTask', [$data->email, $data->password, $data->remember]);

        Apiato::call('Authentication@CheckIfUserIsConfirmedTask', [], [['setUser' => [$user]]]);

        return $user;
    }
}
