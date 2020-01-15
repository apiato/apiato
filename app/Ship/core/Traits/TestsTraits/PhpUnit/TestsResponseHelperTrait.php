<?php

namespace Apiato\Core\Traits\TestsTraits\PhpUnit;

use Illuminate\Support\Arr as LaravelArr;
use Illuminate\Support\Str;
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
     * @param $keys
     */
    public function assertResponseContainKeys($keys)
    {
        if (!is_array($keys)) {
            $keys = (array)$keys;
        }

        $arrayResponse = $this->removeDataKeyFromResponse($this->getResponseContentArray());

        foreach ($keys as $key) {
            $this->assertTrue(array_key_exists($key, $arrayResponse));
        }
    }

    /**
     * @param $values
     */
    public function assertResponseContainValues($values)
    {
        if (!is_array($values)) {
            $values = (array)$values;
        }

        $arrayResponse = $this->removeDataKeyFromResponse($this->getResponseContentArray());

        foreach ($values as $value) {
            $this->assertTrue(in_array($value, $arrayResponse));
        }
    }

    /**
     * @param $data
     */
    public function assertResponseContainKeyValue($data)
    {
        // `responseContentToArray` will remove the `data` node
        $httpResponse = json_encode(LaravelArr::sortRecursive((array)$this->getResponseContentArray()));

        foreach (LaravelArr::sortRecursive($data) as $key => $value) {
            $expected = $this->formatToExpectedJson($key, $value);
            $this->assertTrue(LaravelStr::contains($httpResponse, $expected),
                "The JSON fragment [ {$expected} ] does not exist in the response [ {$httpResponse} ].");
        }
    }

    /**
     * @param array $messages
     */
    public function assertValidationErrorContain(array $messages)
    {
        $responseContent = $this->getResponseContentObject();

        foreach ($messages as $key => $value) {
            $this->assertEquals($responseContent->errors->{$key}[0], $value);
        }
    }

    /**
     * @param $key
     * @param $value
     *
     * @return  string
     */
    private function formatToExpectedJson($key, $value)
    {
        $expected = json_encode([$key => $value]);

        if (Str::startsWith($expected, '{')) {
            $expected = substr($expected, 1);
        }

        if (Str::endsWith($expected, '}')) {
            $expected = substr($expected, 0, -1);
        }

        return trim($expected);
    }

    /**
     * @param array $responseContent
     *
     * @return  array|mixed
     */
    private function removeDataKeyFromResponse(array $responseContent)
    {
        if (array_key_exists('data', $responseContent)) {
            return $responseContent['data'];
        }

        return $responseContent;
    }

}
