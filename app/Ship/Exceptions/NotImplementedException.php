<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class NotImplementedException extends Exception
{
    protected $code = Response::HTTP_NOT_IMPLEMENTED;
    protected $message = 'This method is not yet implemented.';
}
