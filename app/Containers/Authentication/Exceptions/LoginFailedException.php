<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class LoginFailedException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;
    public $message = 'An Exception happened during the Login Process.';
}
