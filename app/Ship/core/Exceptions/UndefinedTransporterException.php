<?php

namespace Apiato\Core\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class UndefinedTransporterException
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class UndefinedTransporterException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Default Transporter for Request not defined. Please override $transporter in Ship\Parents\Request\Request.';

}
