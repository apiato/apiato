<?php

namespace App\Containers\Authorization\Exceptions;

use App\Ship\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RoleNotFoundException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RoleNotFoundException extends Exception
{

    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = 'Role Not Found.';
}
