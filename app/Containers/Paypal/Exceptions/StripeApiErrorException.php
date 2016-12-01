<?php

namespace App\Containers\Paypal\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class StripeApiErrorException.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class PaypalApiErrorException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_EXPECTATION_FAILED;

    public $message = 'Paypal API error.';
}
