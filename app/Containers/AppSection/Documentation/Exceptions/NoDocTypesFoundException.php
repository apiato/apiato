<?php

namespace App\Containers\AppSection\Documentation\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class NoDocTypesFoundException extends Exception
{
    protected $code = Response::HTTP_MISDIRECTED_REQUEST;
    protected $message = 'Please update your config file.';
}
