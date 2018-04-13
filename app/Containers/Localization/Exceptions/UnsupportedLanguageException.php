<?php

namespace App\Containers\Localization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class UnsupportedLanguageException.
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class UnsupportedLanguageException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_PRECONDITION_FAILED;

    public $message = 'Unsupported Language.';
}
