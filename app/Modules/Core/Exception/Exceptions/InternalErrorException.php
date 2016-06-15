<?php

namespace App\Modules\Core\Exception\Exceptions;

use App\Modules\Core\Exception\Abstracts\ApiException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class InternalErrorException.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class InternalErrorException extends ApiException
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Something went wrong!';
}
