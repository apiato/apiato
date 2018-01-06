<?php

namespace App\Containers\Documentation\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NoDocTypesFoundException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class NoDocTypesFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_MISDIRECTED_REQUEST;

    public $message = 'Please Update your config file.';

    public $code = ApplicationErrorCodesTable::BASE_CONFIGURATION_GENERAL_ERROR;
}
