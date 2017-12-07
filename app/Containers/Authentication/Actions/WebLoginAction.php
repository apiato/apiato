<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class WebLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginAction extends Action
{

    /**
     * @param string $email
     * @param string $password
     * @param bool   $remember
     *
     * @return  \Illuminate\Contracts\Auth\Authenticatable
     */
    public function run(string $email, string $password, bool $remember = false): Authenticatable
    {
        $user = Apiato::call('Authentication@WebLoginTask', [$email, $password, $remember]);

        Apiato::call('Authentication@CheckIfUserIsConfirmedTask', [], [['setUser' => [$user]]]);

        return $user;
    }
}
