<?php

namespace Mega\Services\Authentication\Exceptions;

use Mega\Services\Core\Exception\Abstracts\ApiException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UpdateResourceFailedException.
 *
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateResourceFailedException extends ApiException
{
    public $httpStatusCode = Response::HTTP_EXPECTATION_FAILED;

    public $message = 'Failed to Update.';
}
