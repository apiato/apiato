<?php

namespace App\Containers\Wepay\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class ObjectNonChargeableException.
 *
 * @author  Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class ObjectNonChargeableException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Internal Error.';
}
