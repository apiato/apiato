<?php

namespace App\Containers\Payment\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class PaymentAccountDoesNotBelongToUserException extends Exception
{
    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = 'The selected Payment Account does not belong to the current User.';

    public $code = ApplicationErrorCodesTable::AUTHENTICATION_NOT_ALLOWED;
}
