<?php

namespace Mega\Services\Core\Exception\Exceptions;

use Mega\Services\Core\Exception\Abstracts\ApiException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class InternalErrorException
 *
 * @type    Exception
 * @package Mega\Services\Core\Exception\Exceptions
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class InternalErrorException extends ApiException
{
    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Something went wrong!';
}
