<?php

namespace App\Containers\Stripe\Exceptions;

use App\Ship\Exception\Abstracts\Exception;
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
}
