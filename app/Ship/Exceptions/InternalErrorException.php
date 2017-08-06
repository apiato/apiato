<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class InternalErrorException.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class InternalErrorException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Something went wrong!';

}
