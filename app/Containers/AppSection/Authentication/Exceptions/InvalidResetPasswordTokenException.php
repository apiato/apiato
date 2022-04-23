<?php

namespace App\Containers\AppSection\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception as ParentException;
use Symfony\Component\HttpFoundation\Response;

class InvalidResetPasswordTokenException extends ParentException
{
    protected $code = Response::HTTP_FORBIDDEN;
    protected $message = 'Invalid Reset Password Token Provided.';
}
