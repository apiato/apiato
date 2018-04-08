<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = 'Token Expired!';

    public $code = ApplicationErrorCodesTable::AUTHENTICATION_TOKEN_EXPIRED;
}
