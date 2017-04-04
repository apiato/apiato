<?php

namespace App\Ship\Parents\Factories;

use Closure;
use ErrorException;
use Illuminate\Support\Str;
use Response;
use Illuminate\Support\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Pagination\Paginator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ResponseFactory
 *
 *
 */
class ResponseFactory
{
    /**
     * Respond with a created response and associate a location if provided.
     *
     * @param null|string $location
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function created($location = null, $content = null)
    {
        $response = new Response($content);
        $response->setStatusCode(201);

        if (!is_null($location)) {
            $response->header('Location', $location);
        }

        return $response;
    }

    /**
     * Respond with a created response and associate a location if provided.
     *
     * @param null|string $location
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($content, $type)
    {
        $response = response()->json([
            'GUID' => $content->getHashedKey(),
            'message' => $type.' successfully created.',
        ]);
        $response->setStatusCode(201);
        return $response;
    }


    /**
     * Respond with an accepted response and associate a location and/or content if provided.
     *
     * @param null|string $location
     * @param mixed       $content
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function accepted($location = null, $content = null)
    {
        $response = new Response($content);
        $response->setStatusCode(202);

        if (!is_null($location)) {
            $response->header('Location', $location);
        }

        return $response;
    }

    /**
     * Respond with a no content response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContent()
    {
        $response = new Response(null);

        return $response->setStatusCode(204);
    }

    /**
     * Bind a collection to a transformer and start building a response.
     *
     * @param \Illuminate\Support\Collection $collection
     * @param object                         $transformer
     * @param array|\Closure                 $parameters
     * @param \Closure|null                  $after
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function collection($collection, $transformer, $type)
    {
        return fractal()->collection($collection, $transformer, $type);
    }

    /**
     * Bind an item to a transformer and start building a response.
     *
     * @param object   $item
     * @param object   $transformer
     * @param array    $parameters
     * @param \Closure $after
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function item($item, $transformer, $type)
    {
        return fractal()->item($item, $transformer, $type);
    }

    /**
     * Bind a paginator to a transformer and start building a response.
     *
     * @param \Illuminate\Contracts\Pagination\Paginator $paginator
     * @param object                                     $transformer
     * @param array                                      $parameters
     * @param \Closure                                   $after
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginator(LengthAwarePaginator $paginator, $transformer, $type)
    {
        $data = $paginator->getCollection();
        return  fractal()
                ->collection($data, $transformer,$type)
                ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                ->toArray();
    }

    /**
     * Return an error response.
     *
     * @param string $message
     * @param int    $statusCode
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function error($message, $statusCode)
    {
        throw new HttpException($statusCode, $message);
    }

    /**
     * Return a 404 not found error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function errorNotFound($message = 'Not Found')
    {
        $this->error($message, 404);
    }

    /**
     * Return a 400 bad request error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function errorBadRequest($message = 'Bad Request')
    {
        $this->error($message, 400);
    }

    /**
     * Return a 403 forbidden error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function errorForbidden($message = 'Forbidden')
    {
        $this->error($message, 403);
    }

    /**
     * Return a 500 internal server error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function errorInternal($message = 'Internal Error')
    {
        $this->error($message, 500);
    }

    /**
     * Return a 401 unauthorized error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        $this->error($message, 401);
    }

    /**
     * Return a 405 method not allowed error.
     *
     * @param string $message
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function errorMethodNotAllowed($message = 'Method Not Allowed')
    {
        $this->error($message, 405);
    }

    /**
     * Call magic methods beginning with "with".
     *
     * @param string $method
     * @param array  $parameters
     *
     * @throws \ErrorException
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (Str::startsWith($method, 'with')) {
            return call_user_func_array([$this, Str::camel(substr($method, 4))], $parameters);

        // Because PHP won't let us name the method "array" we'll simply watch for it
        // in here and return the new binding. Gross. This is now DEPRECATED and
        // should not be used. Just return an array or a new response instance.
        } elseif ($method == 'array') {
            return new Response($parameters[0]);
        }

        throw new ErrorException('Undefined method '.get_class($this).'::'.$method);
    }
}
