<?php

namespace App\Containers\Authorization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserNotAdminException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserNotAdminException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = 'This User does not have an Admin permission.';
}
