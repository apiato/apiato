<?php

namespace App\Ship\Exceptions;

use App\Ship\Exceptions\Codes\ApplicationErrorCodesTable;
use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ValidationFailedException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ValidationFailedException extends Exception
{

    public $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

    public $message = 'Invalid Input.';

    public $code = ApplicationErrorCodesTable::VALIDATION_GENERAL_ERROR;

}
