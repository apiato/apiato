<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OAuthException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class OAuthException extends Exception
{
    public $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'OAuth 2.0 is not installed!';

    public $code = ApplicationErrorCodesTable::BASE_CONFIGURATION_OAUTH_MISSING;
}
