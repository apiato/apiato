<?php

namespace App\Ship\Engine\Traits;

use App\Containers\Authentication\Exceptions\OAuthException;
use Exception;

/**
 * Class TokenTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait TokenTrait
{

    // TODO: rename this to HasApiTokens and combine both

    /**
     * @param       $tokenName
     * @param array $scopes
     *
     * @return  $this
     * @throws \App\Containers\Authentication\Exceptions\OAuthException
     */
    public function attachAccessToken($tokenName, array $scopes = [])
    {
        try {
            $personalAccessTokenObject = $this->createToken($tokenName, $scopes);

            $this->access_token = $personalAccessTokenObject->accessToken;

        } catch (Exception $e) {
            throw new OAuthException();
        }

        return $this;
    }

}
