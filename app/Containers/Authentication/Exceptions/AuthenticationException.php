<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = 'You have not logged in successfully. Please try again';
}
