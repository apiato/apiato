<?php

namespace App\Containers\AppSection\SocialAuth\Exceptions;

use Apiato\Core\Abstracts\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

final class OAuthIdentityLinkingException extends Exception
{
    protected $code = Response::HTTP_CONFLICT;
    protected $message = 'OAuth identity is already linked to another user';
}
