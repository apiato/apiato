<?php

namespace App\Ship\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UpdateResourceFailedException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateResourceFailedException extends Exception
{

    public $httpStatusCode = Response::HTTP_EXPECTATION_FAILED;

    public $message = 'Failed to update Resource.';

}
