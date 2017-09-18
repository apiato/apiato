<?php

namespace App\Containers\Stripe\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class StripeApiErrorException.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class StripeApiErrorException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_EXPECTATION_FAILED;

    public $message = 'Stripe API error.';
}
