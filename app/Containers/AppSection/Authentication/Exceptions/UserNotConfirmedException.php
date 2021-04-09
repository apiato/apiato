<?php

namespace App\Containers\AppSection\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class UserNotConfirmedException extends Exception
{
    protected $code = Response::HTTP_CONFLICT;
    protected $message = 'The user email is not confirmed yet. Please verify your user before trying to login.';
}
