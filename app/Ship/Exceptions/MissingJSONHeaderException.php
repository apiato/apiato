<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class MissingJSONHeaderException extends Exception
{
    protected $code = SymfonyResponse::HTTP_BAD_REQUEST;
    protected $message = 'Your request must contain [Accept = application/json].';
}
