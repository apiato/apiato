<?php

namespace App\Containers\Wepay\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class PaymentMethodNotFoundException.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class PaymentMethodNotFoundException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_PAYMENT_REQUIRED;

    public $message = 'Payment method is not found.';

    public $code = ApplicationErrorCodesTable::PAYMENT_METHOD_NOT_FOUND;
}
