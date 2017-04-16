<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\AuthenticationFailedException;
use App\Containers\Authentication\Exceptions\OAuthException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\DB;

/**
 * Class InjectClientIdAndSecretTask.
 */
class InjectClientIdAndSecretTask extends Task
{
    /**
     * InjectClientIdAndSecretTask constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $client
     * @param $data
     *
     * @return array
     */
    public function run($client, $data)
    {
        // load the corresponding credentials of my trusted client.
        switch ($client) {
            case 'AdminWeb':
                $clientId = env('CLIENT_WEB_ADMIN_ID');
                $clientSecret = env('CLIENT_WEB_ADMIN_SECRET');
                break;
            case 'ClientWeb':
                // ...
                $clientId = null;
                $clientSecret = null;
                break;
            case 'ClientMobile':
                // ...
                $clientId = null;
                $clientSecret = null;
                break;
        }

        return array_merge($data, [
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ]);
    }
}
