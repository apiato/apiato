<?php

namespace App\Ship\Features\Tests\PhpUnit;

use Dingo\Api\Http\Response as DingoAPIResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr as LaravelArr;
use Illuminate\Support\Str as LaravelStr;

/**
 * Class TestsResponseHelperTrait
 *
 * Tests helper for making formatting and asserting http responses.
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait TestsResponseHelperTrait
{
    /**
     * get response object, get the string content from it and convert it to an std object
     * making it easier to read
     *
     * @param $httpResponse
     *
     * @return  mixed
     */
    public function getResponseContent(Response $httpResponse)
    {
        return json_decode($httpResponse->getContent());
    }

    /**
     * @param $httpResponse
     *
     * @return  mixed
     */
    private function responseToArray($httpResponse)
    {
        if ($httpResponse instanceof \Illuminate\Http\Response) {
            $httpResponse = json_decode($httpResponse->getContent(), true);
        }

        if (array_key_exists('data', $httpResponse)) {
            $httpResponse = $httpResponse['data'];
        }

        return $httpResponse;
    }

    /**
     * @param \Dingo\Api\Http\Response $httpResponse
     * @param array                    $messages
     */
    public function assertValidationErrorContain(DingoAPIResponse $httpResponse, array $messages)
    {
        $arrayResponse = json_decode($httpResponse->getContent());

        foreach ($messages as $key => $value) {
            $this->assertEquals($arrayResponse->errors->{$key}[0], $value);
        }
    }

    /**
     * @param $keys
     * @param $httpResponse
     */
    public function assertResponseContainKeys($keys, $httpResponse)
    {
        if (!is_array($keys)) {
            $keys = (array)$keys;
        }

        foreach ($keys as $key) {
            $this->assertTrue(array_key_exists($key, $this->responseToArray($httpResponse)));
        }
    }

    /**
     * @param $values
     * @param $httpResponse
     */
    public function assertResponseContainValues($values, $httpResponse)
    {
        if (!is_array($values)) {
            $values = (array)$values;
        }

        foreach ($values as $value) {
            $this->assertTrue(in_array($value, $this->responseToArray($httpResponse)));
        }
    }

    /**
     * @param $data
     * @param $httpResponse
     */
    public function assertResponseContainKeyValue($data, $httpResponse)
    {
        $httpResponse = json_encode(LaravelArr::sortRecursive(
            (array)$this->responseToArray($httpResponse)
        ));

        foreach (LaravelArr::sortRecursive($data) as $key => $value) {
            $expected = $this->formatToExpectedJson($key, $value);
            $this->assertTrue(LaravelStr::contains($httpResponse, $expected),
                "The JSON fragment [ {$expected} ] does not exist in the response [ {$httpResponse} ].");
        }
    }

    /**
     * Format the given key and value into a JSON string for expectation checks.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return string
     */
    private function formatToKeyValueToString($key, $value)
    {
        $expected = json_encode([$key => $value]);

        if (LaravelStr::startsWith($expected, '{')) {
            $expected = substr($expected, 1);
        }

        if (LaravelStr::endsWith($expected, '}')) {
            $expected = substr($expected, 0, -1);
        }

        return $expected;
    }

}
