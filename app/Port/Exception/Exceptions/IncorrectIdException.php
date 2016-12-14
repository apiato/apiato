<?php

namespace App\Port\Exception\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class IncorrectIdException.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class IncorrectIdException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_BAD_REQUEST;

    public $message = 'ID input is incorrect.';
}
