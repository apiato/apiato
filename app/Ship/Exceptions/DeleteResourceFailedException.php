<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DeleteResourceFailedException.
 *
 * @author Johannes Schobel <johannes.schobel@googlemail.com>
 */
class DeleteResourceFailedException extends Exception
{

    public $httpStatusCode = Response::HTTP_EXPECTATION_FAILED;

    public $message = 'Failed to delete Resource.';

}
