<?php

namespace Apiato\Core\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class UnsupportedFractalIncludeException.
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class UnsupportedFractalIncludeException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_BAD_REQUEST;

    public $message = 'Requested a invalid Include Parameter.';

}
