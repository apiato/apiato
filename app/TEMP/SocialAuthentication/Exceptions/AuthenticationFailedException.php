<?php

namespace App\Containers\SocialAuthentication\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthenticationFailedException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AuthenticationFailedException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = 'Something went wrong!';
}
