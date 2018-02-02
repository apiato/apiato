<?php

namespace App\Ship\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class EmailIsMissedException.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class EmailIsMissedException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'One of the Emails is missed, check your configuration files.';

    public $code = ApplicationErrorCodesTable::BASE_CONFIGURATION_WRONG;
}
