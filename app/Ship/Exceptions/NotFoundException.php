<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateResourceFailedException.
 *
 * @author Johannes Schobel <johannes.schobel@googlemail.com>
 */
class NotFoundException extends Exception
{

    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = 'The requested Resource was not found.';

}
