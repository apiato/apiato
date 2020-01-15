<?php

namespace Apiato\Core\Exceptions\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Optimus\Heimdal\Formatters\BaseFormatter as HeimdalBaseFormatter;

/**
 * Class ExceptionsFormatter
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class ExceptionsFormatter extends HeimdalBaseFormatter
{

    /**
     * @param \Illuminate\Http\JsonResponse $response
     * @param \Exception                    $exception
     * @param array                         $reporterResponses
     */
    public function format(JsonResponse $response, Exception $exception, array $reporterResponses)
    {
        // allow the formatter to modify the response
        $response = $this->modifyResponse($exception, $response);

        // get response data
        $data = $response->getData(true);

        // merge the error response data from the formatter with the response data. Allowing formatters to override values
        $data = array_merge($data, $this->responseData($exception, $response));

        // append customData if needed
        $data = $this->appendCustomData($data, $exception);

        // add debugging data to the response
        $data = $this->appendDebug($data, $exception);

        // add profiler data to the response
        $data = $this->appendProfiler($data, $exception);

        // get status code from the formatter and set it in response header
        $response->setStatusCode($this->statusCode());

        $response->setData($data);
    }

    /**
     * @param $data
     * @param $exception
     *
     * @return  array
     */
    private function appendCustomData($data, $exception)
    {
        if (method_exists($exception, 'getCustomData')) {
            $customData = $exception->getCustomData();

            // no custom data needs to be appended - skip it for now
            if ($customData === null) {
                return $data;
            }

            if (!is_array($customData)) {
                $customData = ['customData' => $customData];
            }

            $data = array_merge($data,
                $customData
            );
        }

        return $data;
    }

    /**
     * @param $data
     * @param $exception
     *
     * @return  array
     */
    private function appendDebug($data, $exception)
    {
        if (config('app.debug')) {
            $data = array_merge($data, [
                'exception' => get_class($exception),
                'file'      => $exception->getFile(),
                'line'      => $exception->getLine(),
            ]);
        }

        return $data;
    }

    /**
     * @param $data
     * @param $exception
     *
     * @return  array
     */
    private function appendProfiler($data, $exception)
    {
        if (config('apiato.api.debug')) {
            $data = array_merge($data, [
                'trace' => (string)$exception,
            ]);
        }

        return $data;
    }

    /**
     * @param \Exception                    $exception
     * @param \Illuminate\Http\JsonResponse $response
     *
     * @return  mixed
     */
    abstract function responseData(Exception $exception, JsonResponse $response);

    /**
     * @param \Exception                    $exception
     * @param \Illuminate\Http\JsonResponse $response
     *
     * @return  mixed
     */
    abstract function modifyResponse(Exception $exception, JsonResponse $response);

    /**
     * @return  mixed
     */
    abstract function statusCode();
}
