<?php

namespace App\Containers\Authorization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class UserNotAdminException extends Exception
{
    public $httpStatusCode = Response::HTTP_FORBIDDEN;
    public $message = 'This User does not have an Admin permission.';
}
