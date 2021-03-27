<?php

namespace App\Containers\Documentation\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class WrongDocTypeException extends Exception
{
    protected $code = Response::HTTP_MISDIRECTED_REQUEST;
    protected $message = 'Unsupported Documentation Type.';
}
