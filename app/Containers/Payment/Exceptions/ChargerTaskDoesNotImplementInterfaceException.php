<?php

namespace App\Containers\Payment\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class ChargerTaskDoesNotImplementInterfaceException extends Exception
{
    public $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'The task is not valid. Maybe you are missing an Interface?';
}
