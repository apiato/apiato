<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RefreshTokenMissedException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RefreshTokenMissedException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'We could not find the Refresh Token. Maybe none is provided?';
}
