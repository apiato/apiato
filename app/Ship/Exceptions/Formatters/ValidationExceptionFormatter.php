<?php

namespace App\Ship\Exceptions\Formatters;

use Apiato\Core\Abstracts\Exceptions\Formatters\BaseFormatter;
use Exception;
use Illuminate\Http\JsonResponse;

class ValidationExceptionFormatter extends BaseFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $response->setStatusCode(422);

        $data = $response->getData(true);

        $data = array_merge($data, [
            'errors' => $e->errors(),
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
            'status_code' => 422,
        ]);

        if (config('app.debug')) {
            $data = array_merge($data, [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }

        if (config('apiato.api.debug')) {
            $data = array_merge($data, [
                'trace' => (string) $e,
            ]);
        }

        $response->setData($data);

        return $response;
    }
}
