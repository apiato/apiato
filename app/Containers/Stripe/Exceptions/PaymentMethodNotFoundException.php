<?php

namespace App\Containers\Stripe\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class PaymentMethodNotFoundException extends Exception
{
    protected $code = SymfonyResponse::HTTP_PAYMENT_REQUIRED;
    protected $message = 'Payment method is not found.';
}
