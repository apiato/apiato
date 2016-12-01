<?php

namespace App\Containers\Application\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApplicationNotFoundException.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApplicationNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Could not find the Application in our database.';
}
