<?php

namespace App\Containers\ApiAuthentication\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MissingAgentIdException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class MissingAgentIdException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Agent ID is required.';
}
