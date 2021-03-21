<?php

namespace App\Containers\Localization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UnsupportedLanguageException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_PRECONDITION_FAILED;
    public $message = 'Unsupported Language.';
}
