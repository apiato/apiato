<?php

namespace App\Containers\AppSection\User\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidResetPasswordTokenException extends Exception
{
    protected $code = Response::HTTP_FORBIDDEN;
    protected $message = 'Invalid Reset Password Token Provided.';
}
