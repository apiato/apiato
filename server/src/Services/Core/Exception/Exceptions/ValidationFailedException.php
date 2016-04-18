<?php

namespace Mega\Services\Core\Exception\Exceptions;

use Dingo\Api\Exception\ResourceException as DingoResourceException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class ValidationFailedException
 *
 * Note: exceptionally extending from `Dingo\Api\Exception\ResourceException` instead of
 * `Mega\Services\Core\Exception\Abstracts\ApiException`. To keep the request validation
 * throwing well formatted error. To be debugged later and switched to extending from
 * `ApiException` while carefully looking at the validation response error format.
 *
 * @type    Exception
 * @package Mega\Services\Core\Exception\Exceptions
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ValidationFailedException extends DingoResourceException
{

    public $httpStatusCode = SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY;

    public $message = 'Invalid Input.';

    /**
     * ValidationFailedException constructor.
     *
     * @param null                                           $errors
     * @param \Mega\Services\Core\Exception\Exceptions\Exception|null $previous
     * @param array                                          $headers
     * @param int                                            $code
     */
    public function __construct($errors = null, Exception $previous = null, $headers = [], $code = 0)
    {
        parent::__construct($this->message, $errors, $previous, $headers, $code);
    }

}
