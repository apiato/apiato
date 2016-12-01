<?php

namespace App\Containers\User\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserNotFoundException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Could not find the User in our database.';
}
