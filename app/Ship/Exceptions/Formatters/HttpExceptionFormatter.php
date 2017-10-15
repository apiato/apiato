<?php

namespace App\Ship\Exceptions\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;

class HttpExceptionFormatter extends ExceptionFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        // build the basic exception
        parent::format($response, $e, $reporterResponses);

        if (count($headers = $e->getHeaders())) {
            $response->headers->add($headers);
        }

        // add the http status
        $response->setStatusCode($e->getStatusCode());
        $data = $response->getData(true);

        $data = array_merge($data, [
            'status_code' => $e->getStatusCode(),
        ]);

        $response->setData($data);
    }
}
