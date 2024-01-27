<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class AccessDeniedException extends Exception
{
    protected $code = Response::HTTP_FORBIDDEN;
    protected $message = 'This action is unauthorized.';
}
