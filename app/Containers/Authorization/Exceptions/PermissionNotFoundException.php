<?php

namespace App\Containers\Authorization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class PermissionNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_NOT_FOUND;
    public $message = 'The requested Permission was not found.';
}
