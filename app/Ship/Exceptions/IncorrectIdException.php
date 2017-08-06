<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
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
