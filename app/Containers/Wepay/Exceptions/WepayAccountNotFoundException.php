<?php

namespace App\Containers\Wepay\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class WepayAccountNotFoundException.
 *
 * @author  Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class WepayAccountNotFoundException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_EXPECTATION_FAILED;

    public $message = 'Wepay Account not found.';

    public $code = ApplicationErrorCodesTable::PAYMENT_ACCOUNT_NOT_FOUND;
}
