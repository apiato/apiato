<?php

namespace App\Containers\Documentation\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class WrongDocTypeException extends Exception
{
    public $httpStatusCode = Response::HTTP_MISDIRECTED_REQUEST;
    public $message = 'Unsupported Documentation Type.';
}
