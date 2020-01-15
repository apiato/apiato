<?php

namespace Optimus\Heimdal\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Optimus\Heimdal\Formatters\BaseFormatter;

class UnprocessableEntityHttpExceptionFormatter extends BaseFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $response->setStatusCode(422);
        
        // Laravel validation errors will return JSON string
        $decoded = json_decode($e->getMessage(), true);
        // Message was not valid JSON
        // This occurs when we throw UnprocessableEntityHttpExceptions
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Mimick the structure of Laravel validation errors
            $decoded = [[$e->getMessage()]];
        }

        // Laravel errors are formatted as {"field": [/*errors as strings*/]}
        $data = array_reduce($decoded, function ($carry, $item) use ($e) {
            return array_merge($carry, array_map(function ($current) use ($e) {
                return [
                    'status' => '422',
                    'code' => $e->getCode(),
                    'title' => 'Validation error',
                    'detail' => $current
                ];
            }, $item));
        }, []);

        $response->setData([
            'errors' => $data
        ]);

        return $response;
    }
}
