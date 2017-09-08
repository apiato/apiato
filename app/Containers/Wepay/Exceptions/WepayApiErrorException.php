<?php

namespace App\Containers\Wepay\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class WepayApiErrorException.
 *
 * @author  Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class WepayApiErrorException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_EXPECTATION_FAILED;

    public $message = 'Wepay API error.';
}
