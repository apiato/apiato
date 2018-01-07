<?php

namespace App\Containers\Stripe\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class PaymentFailedException.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class PaymentFailedException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_PAYMENT_REQUIRED;

    public $message = 'Payment failed!';

    public $code = ApplicationErrorCodesTable::PAYMENT_TRANSACTION_FAILED;
}
