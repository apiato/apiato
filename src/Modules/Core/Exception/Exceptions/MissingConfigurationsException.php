<?php

namespace Hello\Modules\Core\Exception\Exceptions;

use Hello\Modules\Core\Exception\Abstracts\ApiException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class MissingConfigurationsException
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MissingConfigurationsException extends ApiException
{
    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Some configurations are missed!';
}
