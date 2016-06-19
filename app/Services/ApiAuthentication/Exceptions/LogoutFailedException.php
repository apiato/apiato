<?php

namespace App\Services\ApiAuthentication\Exceptions;

use App\Engine\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthenticationFailedException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LogoutFailedException extends Exception
{

    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Failed to logout!';
}
