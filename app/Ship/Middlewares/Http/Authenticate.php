<?php

namespace App\Ship\Middlewares\Http;

use App\Containers\Authentication\Exceptions\AuthenticationException;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as LaravelAuthenticate;

/**
 * Class Authenticate
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Authenticate extends LaravelAuthenticate
{

    /**
     * We are re-implementing this specific function in order to allow for a "better" error handling.
     * Basically, we are "wrapping" the Laravel AuthenticationException with our own!
     *
     * @param array $guards
     *
     * @throws AuthenticationException
     */
    public function authenticate(array $guards)
    {
        try {
            return parent::authenticate($guards);
        }
        catch (Exception $exception) {
            throw new AuthenticationException();
        }
    }

}
