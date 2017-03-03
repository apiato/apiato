<?php

namespace App\Ship\Engine\Exceptions;

use Exception;
use Illuminate\Support\Facades\Config;
use Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as LaravelExceptionHandler;
use App\Ship\Engine\Traits\RestTrait;

/**
 * Class ShipExceptionsHandler.
 *
 * A.K.A (app/Exceptions/Handler.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ShipExceptionsHandler extends LaravelExceptionHandler
{
    use RestTrait;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
//        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
//        \Illuminate\Auth\AuthenticationException::class,
//        \Illuminate\Auth\Access\AuthorizationException::class,
//        \Illuminate\Session\TokenMismatchException::class,
//        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (!$this->isApiCall($request)) {
            return parent::render($request, $exception);
        } else {
            $response = [];
            if (Config::get('app.env') !== 'production') {
                $response['exception'] = class_basename($exception).' in '.basename($exception->getFile()).' line '.$exception->getLine().': '.$exception->getMessage();
            }
            $response['message'] = $exception->getMessage();

            if (isset($exception->httpStatusCode)) {
                $response['status_code'] = $exception->httpStatusCode;
            }

            if (class_basename($exception) == 'ValidationFailedException') {
                $response['errors'] = $exception->getErrors();
            }

            return Response::json($response, $exception->httpStatusCode ?? 500);
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
