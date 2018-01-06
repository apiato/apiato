<?php

namespace App\Containers\Payment\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class NoChargeTaskForPaymentGatewayDefinedException extends Exception
{
    public $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'No Charge Task for this Payment Gateway defined!';

    public $code = ApplicationErrorCodesTable::BASE_CONFIGURATION_GENERAL_ERROR;
}
