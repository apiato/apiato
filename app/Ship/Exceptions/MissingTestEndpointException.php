<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class MissingTestEndpointException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MissingTestEndpointException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Property ($this->endpoint) is missed in your test.';

}
