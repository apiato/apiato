<?php

namespace App\Containers\SocialAuth\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class AccountFailedException extends Exception
{
	public $httpStatusCode = Response::HTTP_CONFLICT;
	public $message = 'Failed creating a new User for Social Authentication.';
}
