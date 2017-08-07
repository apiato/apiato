<?php

namespace App\Containers\Settings\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

class SettingNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = 'Application Setting not found.';
}
