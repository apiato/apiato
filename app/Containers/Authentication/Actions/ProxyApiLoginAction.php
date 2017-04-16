<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\OAuthProxyTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ProxyApiLoginAction.
 */
class ProxyApiLoginAction extends Action
{
    /**
     * @param $email
     * @param $password
     * @param $client
     *
     * @return mixed
     */
    public function run($email, $password, $client)
    {
        $data = [
            'username'   => $email,
            'password'   => $password,
            'grant_type' => 'password',
            'scope'      => '',
        ];

        return $this->call(OAuthProxyTask::class, [$data, $client]);
    }
}
