<?php

namespace App\Containers\AppSection\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception as ParentException;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMissingException extends ParentException
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'We could not find the Refresh Token. Maybe none is provided?';
}
