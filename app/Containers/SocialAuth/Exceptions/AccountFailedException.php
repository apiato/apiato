<?php

namespace App\Containers\Socialauth\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AccountFailedException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AccountFailedException extends Exception
{

    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = 'Failed creating new User.';
}
