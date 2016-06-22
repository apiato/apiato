<?php

namespace App\Kernel\Configuration\Exceptions;

use App\Kernel\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class WrongConfigurationsException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class WrongConfigurationsException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Ops! Some Containers configurations (config/megavel.php) are wrong!';
}
