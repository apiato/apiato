<?php

namespace App\Containers\AppSection\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\HttpException as ParentHttpException;
use Symfony\Component\HttpFoundation\Response;

final class LoginFailed extends ParentHttpException
{
    public static function create(): self
    {
        return new self(Response::HTTP_UNPROCESSABLE_ENTITY, 'Login Failed.');
    }
}
