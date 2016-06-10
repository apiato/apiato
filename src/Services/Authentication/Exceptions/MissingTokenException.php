<?php

namespace Hello\Services\Authentication\Exceptions;

use Hello\Modules\Core\Exception\Abstracts\ApiException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MissingTokenException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class MissingTokenException extends ApiException
{

    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Token is required.';
}
