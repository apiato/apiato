<?php

namespace Mega\Modules\User\Exceptions;

use Mega\Services\Core\Exception\Abstracts\ApiException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AccountFailedException
 *
 * @type Exception
 * @package  Mega\Modules\User\Exceptions
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class AccountFailedException extends ApiException
{

    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = 'Failed creating new User.';
}
