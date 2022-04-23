<?php

namespace App\Ship\Exceptions\Handlers;

use Apiato\Core\Abstracts\Exceptions\Exception as CoreException;
use Apiato\Core\Exceptions\AuthenticationException as CoreAuthenticationException;
use Apiato\Core\Exceptions\Handlers\ExceptionsHandler as CoreExceptionsHandler;
use App\Ship\Exceptions\NotAuthorizedResourceException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Providers\RouteServiceProvider;
use Illuminate\Auth\AuthenticationException as LaravelAuthenticationException;
use Illuminate\Http\JsonResponse;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

/**
 * Class ExceptionsHandler
 *
 * A.K.A. (app/Exceptions/Handler.php)
 */
class ExceptionsHandler extends CoreExceptionsHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(static function (Throwable $e) {
        });

        $this->renderable(function (CoreException $e) {
            return $this->buildResponse($e);
        });

        $this->renderable(function (NotFoundHttpException $e) {
            return $this->buildResponse(new NotFoundException());
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            return $this->shouldReturnJson($request, $e)
                ? $this->buildResponse(new NotAuthorizedResourceException())
                : redirect()->guest(route(RouteServiceProvider::UNAUTHORIZED));
        });
    }

    private function buildResponse(CoreException $e): JsonResponse
    {
        if (config('app.debug')) {
            $response = [
                'message' => $e->getMessage(),
                'errors' => $e->getErrors(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace(),
            ];
        } else {
            $response = [
                'message' => $e->getMessage(),
                'errors' => $e->getErrors(),
            ];
        }

        return response()->json($response, (int)$e->getCode());
    }

    protected function unauthenticated($request, LaravelAuthenticationException $e): JsonResponse|Response
    {
        return $this->shouldReturnJson($request, $e)
            ? $this->buildResponse(new CoreAuthenticationException())
            : redirect()->guest(route(RouteServiceProvider::LOGIN));
    }
}
