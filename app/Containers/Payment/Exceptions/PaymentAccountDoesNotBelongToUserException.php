<?php

namespace App\Containers\Payment\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class PaymentAccountDoesNotBelongToUserException extends Exception
{
    protected $code = Response::HTTP_CONFLICT;
    protected $message = 'The selected Payment Account does not belong to the current User.';
}
