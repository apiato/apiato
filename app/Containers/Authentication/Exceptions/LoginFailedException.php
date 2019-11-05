<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginFailedException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class LoginFailedException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $code = 1;

    public $message = 'You have not logged in successfully. Please try again';
}
