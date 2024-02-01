<?php

namespace App\Containers\AppSection\SocialAuth\Exceptions;

use Apiato\Core\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class OAuthIdentityLinkingFailedException extends Exception
{
    protected $code = Response::HTTP_CONFLICT;
    protected $message = 'Failed to link/unlink OAuth identity';
}
