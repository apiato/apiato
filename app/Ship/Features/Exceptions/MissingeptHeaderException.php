<?php

namespace App\Ship\Features\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class MissingeptHeaderException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MissingeptHeaderException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_BAD_REQUEST;

    public $message = 'Your request must contain [Accept = application/json].';
}
