<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\OAuthProxyTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class ProxyApiRefreshAction.
 */
class ProxyApiRefreshAction extends Action
{
    /**
     * @param $refresh_token
     * @param $client
     *
     * @return mixed
     */
    public function run($refresh_token, $client)
    {
        $data = [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refresh_token,
            'scope'         => '',
        ];

        return $this->call(OAuthProxyTask::class, [$data, $client]);
    }
}
