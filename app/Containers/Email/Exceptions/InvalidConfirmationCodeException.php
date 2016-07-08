<?php

namespace App\Containers\Email\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InvalidConfirmationCodeException
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class InvalidConfirmationCodeException extends Exception
{

    public $httpStatusCode = Response::HTTP_EXPECTATION_FAILED;

    public $message = 'Email Confirmation Code is invalid.';
}
