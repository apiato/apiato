<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class MissingJSONHeaderException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MissingJSONHeaderException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_BAD_REQUEST;

    public $message = 'Your request must contain [Accept = application/json].';

}
