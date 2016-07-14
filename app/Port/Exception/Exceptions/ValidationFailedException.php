<?php

namespace App\Port\Exception\Exceptions;

use Dingo\Api\Exception\ResourceException as DingoResourceException;
use Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class ValidationFailedException.
 *
 * Note: exceptionally extending from `Dingo\Api\Exception\ResourceException` instead of
 * `App\Port\Exception\Abstracts\Exception`. To keep the request validation
 * throwing well formatted error. To be debugged later and switched to extending from
 * `Exception` while carefully looking at the validation response error format.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ValidationFailedException extends DingoResourceException
{

    public $httpStatusCode = SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY;

    public $message = 'Invalid Input.';

    /**
     * ValidationFailedException constructor.
     *
     * @param null            $errors
     * @param \Exception|null $previous
     * @param array           $headers
     * @param int             $code
     */
    public function __construct($errors = null, Exception $previous = null, $headers = [], $code = 0)
    {
        parent::__construct($this->message, $errors, $previous, $headers, $code);
    }
}
