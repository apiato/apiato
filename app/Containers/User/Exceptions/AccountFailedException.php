<?php

namespace App\Containers\User\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AccountFailedException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AccountFailedException extends Exception
{

    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = 'Failed creating new User.';
}
