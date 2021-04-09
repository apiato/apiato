<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationException extends Exception
{
    protected $code = RESPONSE::HTTP_UNAUTHORIZED;
    protected $message = 'An Exception occurred when trying to authenticate the User.';
}
