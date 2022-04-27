<?php

namespace App\Containers\AppSection\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception as ParentException;
use Symfony\Component\HttpFoundation\Response;

class EmailNotVerifiedException extends ParentException
{
    protected $code = Response::HTTP_FORBIDDEN;
    protected $message = 'Your email address is not verified.';
}
