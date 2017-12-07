<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\UserNotAdminException;
use App\Ship\Parents\Actions\Action;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class WebAdminLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebAdminLoginAction extends Action
{

    /**
     * @param string $email
     * @param string $password
     * @param bool   $rememberMe
     *
     * @return  \Illuminate\Contracts\Auth\Authenticatable
     */
    public function run(string $email, string $password, bool $rememberMe = false): Authenticatable
    {
        $user = Apiato::call('Authentication@WebLoginTask', [$email, $password, $rememberMe]);

        Apiato::call('Authentication@CheckIfUserIsConfirmedTask', [], [['setUser' => [$user]]]);

        if (!$user->hasAdminRole()) {
            throw new UserNotAdminException();
        }

        return $user;
    }
}
