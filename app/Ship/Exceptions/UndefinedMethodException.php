<?php

namespace App\Ship\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class UndefinedMethodException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UndefinedMethodException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_METHOD_NOT_ALLOWED;

    public $message = 'Undefined HTTP Verb!';

    public $code = ApplicationErrorCodesTable::REQUEST_GENERAL_WRONG_METHOD;

}
