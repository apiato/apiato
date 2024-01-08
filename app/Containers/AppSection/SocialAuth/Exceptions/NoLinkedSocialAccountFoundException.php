<?php

namespace App\Containers\AppSection\SocialAuth\Exceptions;

use Apiato\Core\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class NoLinkedSocialAccountFoundException extends Exception
{
    protected $code = Response::HTTP_NOT_FOUND;
    protected $message = 'No linked social account found.';
}
