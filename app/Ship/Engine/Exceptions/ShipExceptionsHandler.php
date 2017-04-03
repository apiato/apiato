<?php

namespace App\Ship\Engine\Exceptions;

use App\Ship\Engine\Traits\RestTrait;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as LaravelExceptionHandler;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ShipExceptionsHandler
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
     * @param  \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
//        if ($exception instanceof ModelNotFoundException) {
//            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
//        }


        // ----------------------------------
        // TODO:

        if (!$this->isApiCall($request)) {
            return parent::render($request, $exception);
        } else {
            // dd(class_basename($exception));
            $response = [];
            if (Config::get('app.env') !== 'production') {
                $response['exception'] = class_basename($exception).' in '.basename($exception->getFile()).' line '.$exception->getLine().': '.$exception->getMessage();
            }
            $response['message'] = $exception->getMessage();
            if ($exception->getPrevious()) {
                $response['previous_message'] = $exception->getPrevious()->getMessage();
            }

            if (isset($exception->httpStatusCode)) {
                $response['status_code'] = $exception->httpStatusCode;
            }

            if (class_basename($exception) == 'ValidationFailedException') {
                $response['errors'] = $exception->getErrors();
            }

            if(class_basename($exception) == 'AuthenticationException'){
                $exception->httpStatusCode = 401;
            }

            // ----------------------------------

            return Response::json($response, $exception->httpStatusCode ?? 500);
        }

//        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request                 $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
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
