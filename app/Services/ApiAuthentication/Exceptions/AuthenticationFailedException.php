<?php

namespace App\Services\ApiAuthentication\Exceptions;

use App\Kernel\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthenticationFailedException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AuthenticationFailedException extends Exception
{

    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = 'Credentials Incorrect.';
}
