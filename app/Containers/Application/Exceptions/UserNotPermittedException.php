<?php

namespace App\Containers\Application\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserNotPermittedException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserNotPermittedException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNAUTHORIZED;

    public $message = 'User is not permitted to perform this action. Request Developer Permission first.';
}
