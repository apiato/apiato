<?php

namespace Mega\Services\Core\Exception\Exceptions;

use Mega\Services\Core\Exception\Abstracts\ApiException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class UnsupportedFractalSerializerException
 *
 * @type    Exception
 * @package Mega\Services\Core\Exception\Exceptions
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class UnsupportedFractalSerializerException extends ApiException
{
    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;
}
