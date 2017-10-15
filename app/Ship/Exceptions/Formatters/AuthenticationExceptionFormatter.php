<?php

namespace App\Ship\Exceptions\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;

class AuthenticationExceptionFormatter extends ExceptionFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        // build the basic exception
        parent::format($response, $e, $reporterResponses);

        $httpstatus = 401;

        // add the http status
        $response->setStatusCode($httpstatus);
        $data = $response->getData(true);

        $data = array_merge($data, [
            'status_code' => $httpstatus,
            'errors' => 'Missing or invalid Access Token!',
        ]);

        $response->setData($data);
    }
}
