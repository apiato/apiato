<?php

namespace App\Containers\Stripe\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class StripeAccountNotFoundException.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class StripeAccountNotFoundException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_EXPECTATION_FAILED;

    public $message = 'Stripe Account not found.';

    public $code = ApplicationErrorCodesTable::PAYMENT_ACCOUNT_NOT_FOUND;
}
