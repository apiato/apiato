<?php

namespace App\Port\Exception\Abstracts;

use Dingo\Api\Contract\Debug\MessageBagErrors as DingoMessageBagErrors;
use Exception as BaseException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\MessageBag;
use Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

/**
 * Class Exception.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Exception extends SymfonyHttpException implements DingoMessageBagErrors
{

    /**
     * MessageBag errors.
     *
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Default status code.
     *
     * @var int
     */
    protected $defaultHttpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @var string
     */
    protected $environment;

    /**
     * Exception constructor.
     *
     * @param null            $message
     * @param null            $errors
     * @param null            $statusCode
     * @param int             $code
     * @param \Exception|null $previous
     * @param array           $headers
     */
    public function __construct(
        $message = null,
        $errors = null,
        $statusCode = null,
        $code = 0,
        BaseException $previous = null,
        $headers = []
    ) {

        // detect and set the running environment
        $this->environment = Config::get('app.env');

        if (is_null($message) && property_exists($this, 'message')) {
            $message = $this->message;
        }

        if (is_null($errors)) {
            $this->errors = new MessageBag();
        } else {
            $this->errors = is_array($errors) ? new MessageBag($errors) : $errors;
        }

        if (is_null($statusCode)) {
            if (property_exists($this, 'httpStatusCode')) {
                $statusCode = $this->httpStatusCode;
            } else {
                $statusCode = $this->defaultHttpStatusCode;
            }
        }

        // if not testing environment, log the error message
        if ($this->environment != 'testing') {
            Log::error('[ERROR] ' .
                'Status Code: ' . $statusCode . ' | ' .
                'Message: ' . $message . ' | ' .
                'Errors: ' . $this->errors . ' | ' .
                'Code: ' . $code
            );
        }

        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }

    /**
     * Help developers debug the error without showing these details to the end user.
     * Usage: `throw (new MyCustomException())->debug($e)`.
     *
     * @param $error
     * @param $force
     *
     * @return $this
     */
    public function debug($error, $force = false)
    {
        if ($error instanceof BaseException) {
            $error = $error->getMessage();
        }

        if ($this->environment != 'testing' || $force === true) {
            Log::error('[DEBUG] ' . $error);
        }

        return $this;
    }

    /**
     * Get the errors message bag.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Determine if message bag has any errors.
     *
     * @return bool
     */
    public function hasErrors()
    {
        return !$this->errors->isEmpty();
    }
}
