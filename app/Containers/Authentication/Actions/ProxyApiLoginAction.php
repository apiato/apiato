<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter;
use App\Ship\Parents\Actions\Action;

/**
 * Class ProxyApiLoginAction.
 */
class ProxyApiLoginAction extends Action
{

    /**
     * @param \App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter $data
     *
     * @return array
     */
    public function run(ProxyApiLoginTransporter $data): array
    {
        $requestData = [
            'grant_type'    => $data->grant_type ?? 'password',
            'client_id'     => $data->client_id,
            'client_secret' => $data->client_password,
            // 'username'      => $data->email,
            'password'      => $data->password,
            'scope'         => $data->scope ?? '',
        ];

        $prefix = config('authentication-container.login.prefix', '');
        $allowedLoginFields = config('authentication-container.login.allowed_login_attributes', ['email' => []]);
        $fields = array_keys($allowedLoginFields);

        $loginUsername = null;
        $loginAttribute = null;

        foreach ($fields as $field)
        {
            $fieldname = $prefix . $field;
            $loginUsername = $data->getInputByKey($fieldname);
            $loginAttribute = $field;

            if ($loginUsername !== null) {
                break;
            }
        }

        $requestData = array_merge($requestData,
            [
                'username' => $loginUsername,
            ]
        );

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);

        // check if user email is confirmed only if that feature is enabled.
        Apiato::call('Authentication@CheckIfUserIsConfirmedTask', [],
            [['loginWithCredentials' => [$requestData['username'], $requestData['password'], $loginAttribute]]]);

        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response_content' => $responseContent,
            'refresh_cookie'   => $refreshCookie,
        ];
    }
}
