<?php

namespace App\Containers\Socialauth\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UnsupportedSocialAuthProviderException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UnsupportedSocialAuthProviderException extends Exception
{
    public $httpStatusCode = Response::HTTP_NOT_ACCEPTABLE;

    public $message = 'Unsupported Social Auth Provider.';
}
