<?php

namespace App\Containers\AppSection\User\Exceptions;

use App\Ship\Parents\Exceptions\HttpException as ParentHttpException;
use Symfony\Component\HttpFoundation\Response;

final class FailedToDeleteUser extends ParentHttpException
{
    public static function becauseCannotDeleteItself(): self
    {
        return new self(Response::HTTP_UNPROCESSABLE_ENTITY, 'You cannot delete yourself.');
    }
}
