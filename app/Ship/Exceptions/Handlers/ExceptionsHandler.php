<?php

namespace App\Ship\Exceptions\Handlers;

use Apiato\Core\Abstracts\Exceptions\Exception as CoreException;
use Apiato\Core\Exceptions\AuthenticationException as CoreAuthenticationException;
use Apiato\Core\Exceptions\Handlers\ExceptionsHandler as CoreExceptionsHandler;
use App\Ship\Exceptions\AccessDeniedException;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Auth\AuthenticationException as LaravelAuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ExceptionsHandler.
 * A.K.A. app/Exceptions/Handler.php.
 */
class ExceptionsHandler extends CoreExceptionsHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(static function (\Throwable $e) {
        });

        $this->renderable(function (CoreException $e, $request) {
            if ($this->shouldReturnJson($request, $e)) {
                return $this->buildJsonResponse($e);
            }

            return $this->renderExceptionResponse($request, $e);
        });

        $this->renderable(function (NotFoundHttpException|ModelNotFoundException $e, $request) {
            if ($this->shouldReturnJson($request, $e)) {
                return $this->buildJsonResponse(new NotFoundException());
            }

            return $this->renderExceptionResponse($request, $e);
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($this->shouldReturnJson($request, $e)) {
                return $this->buildJsonResponse(new AccessDeniedException());
            }

            return redirect()->guest(route('unauthorized-page'));
        });
    }

    private function buildJsonResponse(CoreException $e): JsonResponse
    {
        if (!App::isProduction()) {
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

        return response()->json($response, (int) $e->getCode());
    }

    protected function unauthenticated($request, LaravelAuthenticationException $e): JsonResponse|RedirectResponse
    {
        if ($this->shouldReturnJson($request, $e)) {
            return $this->buildJsonResponse(new CoreAuthenticationException());
        }

        return redirect()->guest(route('login-page'));
    }
}
