<?php

namespace App\Containers\Stripe\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class PaymentFailedException extends Exception
{
    protected $code = SymfonyResponse::HTTP_PAYMENT_REQUIRED;
    protected $message = 'Payment failed!';
}
