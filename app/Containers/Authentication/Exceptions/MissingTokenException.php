<?php

namespace App\Containers\Authentication\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MissingTokenException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class MissingTokenException extends Exception
{

    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Token is required.';
}
