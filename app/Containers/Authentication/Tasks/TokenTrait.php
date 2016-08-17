<?php

namespace App\Containers\Authentication\Tasks;

/**
 * Class TokenTrait.
 *
 * To be `used` by the `User` Model.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
trait TokenTrait
{

    /**
     * inject a token in the user model itself.
     * if no token provided generate token first.
     *
     * @param null $token
     *
     * @return $this
     */
    public function injectToken($token)
    {
        // attach the token on the user
        $this->token = $token;

        return $this;
    }
}
