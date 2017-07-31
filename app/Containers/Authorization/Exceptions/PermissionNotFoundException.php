<?php

namespace App\Containers\Authorization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RoleNotFoundException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class PermissionNotFoundException extends Exception
{

    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = 'Permission Not Found.';
}
