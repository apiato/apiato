<?php

namespace App\Containers\AppSection\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class EmailNotVerifiedException extends Exception
{
    protected $code = Response::HTTP_FORBIDDEN;
    protected $message = 'Your email address is not verified.';
}
