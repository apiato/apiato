<?php

namespace App\Containers\Authorization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RoleNotFoundException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RoleNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = 'The requested Role was not found.';
}
