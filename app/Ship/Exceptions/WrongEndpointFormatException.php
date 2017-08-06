<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class WrongEndpointFormatException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class WrongEndpointFormatException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'tests ($this->endpoint) property must be formatted as "verb@url".';

}
