<?php

namespace App\Containers\Authentication\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MissingVisitorIdException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class MissingVisitorIdException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = '(visitor-id) is required.';
}
