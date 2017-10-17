<?php

namespace App\Ship\Exceptions\Formatters;

use Apiato\Core\Exceptions\Formatters\ExceptionsFormatter as CoreExceptionsFormatter;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class UnprocessableEntityHttpExceptionFormatter
 *
 * @author Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UnprocessableEntityHttpExceptionFormatter extends CoreExceptionsFormatter
{

    /**
     * Status Code.
     *
     * @var  int
     */
    CONST STATUS_CODE = 422;

    /**
     * @param \Exception                    $exception
     * @param \Illuminate\Http\JsonResponse $response
     *
     * @return  array
     */
    public function responseData(Exception $exception, JsonResponse $response)
    {
        // Laravel validation errors will return JSON string
        $decoded = json_decode($exception->getMessage(), true);
        // Message was not valid JSON
        // This occurs when we throw UnprocessableEntityHttpExceptions
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Mimic the structure of Laravel validation errors
            $decoded = [[$exception->getMessage()]];
        }

        // Laravel errors are formatted as {"field": [/*errors as strings*/]}
        $responseData = array_reduce($decoded, function ($carry, $item) use ($exception) {
            return array_merge($carry, array_map(function ($current) use ($exception) {
                return [
                    'status' => self::STATUS_CODE,
                    'code'   => $exception->getCode(),
                    'title'  => 'Validation error',
                    'detail' => $current
                ];
            }, $item));
        }, []);

        return [
            'code'    => $exception->getCode(),
            'message' => $exception->getMessage(),
            'errors' => $responseData,
        ];
    }


    /**
     * @param \Exception                    $exception
     * @param \Illuminate\Http\JsonResponse $response
     *
     * @return  mixed
     */
    function modifyResponse(Exception $exception, JsonResponse $response)
    {
        return $response;
    }

    /**
     * @return  int
     */
    public function statusCode()
    {
        return self::STATUS_CODE;
    }


}
