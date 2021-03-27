<?php

namespace App\Containers\Stripe\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class StripeAccountNotFoundException extends Exception
{
    protected $code = SymfonyResponse::HTTP_EXPECTATION_FAILED;
    protected $message = 'Stripe Account not found.';
}
