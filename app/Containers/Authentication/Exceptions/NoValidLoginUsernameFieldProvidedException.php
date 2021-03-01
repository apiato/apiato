<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Exception as BaseException;
use Symfony\Component\HttpFoundation\Response;

class NoValidLoginUsernameFieldProvidedException extends Exception
{
    public int $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
    public $message;

    public function __construct($message = null, $errors = null, $statusCode = null, $code = 0, BaseException $previous = null, $headers = [])
    {
        parent::__construct($message, $errors, $statusCode, $code, $previous, $headers);

        $attributes = array_keys(config('authentication-container.login.attributes'));
        $this->message = $message ?? 'No valid login username field (e.g. email, phone, etc...) is provided. Valid options: ' . implode(',', $attributes);
    }
}
