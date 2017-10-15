<?php

namespace App\Ship\Exceptions\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;

class MethodNotAllowedExceptionFormatter extends ExceptionFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        // build the basic exception
        parent::format($response, $e, $reporterResponses);

        $httpstatus = 405;

        // add the http status
        $response->setStatusCode($httpstatus);
        $data = $response->getData(true);

        $data = array_merge($data, [
            'status_code' => $httpstatus,
            'errors' => 'Method Not Allowed!',
        ]);

        $response->setData($data);
    }
}
