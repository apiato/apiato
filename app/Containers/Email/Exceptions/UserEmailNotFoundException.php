<?php

namespace App\Containers\Email\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserEmailNotFoundException
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserEmailNotFoundException extends Exception
{

    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'The User Does not have an Email.';
}
