<?php

namespace App\Ship\Engine\Traits;

use Fractal;
use Illuminate\Http\JsonResponse;

/**
 * Class ResponseTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait ResponseTrait
{

    /**
     * @param $data
     * @param $transformerName
     *
     * @return  mixed
     */
    public function transform($data, $transformerName = null)
    {
        return Fractal::create($data, new $transformerName)->toJson();
    }

    /**
     * @param       $message
     * @param int   $status
     * @param array $headers
     * @param int   $options
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function json($message, $status = 200, array $headers = array(), $options = 0)
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * @param string|array $message
     * @param int          $status
     * @param array        $headers
     * @param int          $options
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function accepted($message = null, $status = 202, array $headers = array(), $options = 0)
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * @param int $status
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function noContent($status = 204)
    {
        return new JsonResponse(null, $status);
    }

}
