<?php

namespace App\Ship\Features\Tests\PhpUnit;

use App;
use Artisan;
use Dingo\Api\Http\Response as DingoAPIResponse;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr as LaravelArr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str as LaravelStr;
use Mockery;
use Symfony\Component\Debug\Exception\UndefinedMethodException;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class GeneralTestsHelpersTrait
 *
 * General Tests helpers for making HTTP calls, formatting response, Mocking services and more..
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait GeneralTestsHelpersTrait
{

    // ---[ HTTP CALLS ]------------------------------------------------------------------------------------------------

    /**
     * @param        $endpoint
     * @param string $verb
     * @param array  $data
     * @param bool   $protected
     * @param array  $headers
     *
     * @return  mixed
     * @throws \Symfony\Component\Debug\Exception\UndefinedMethodException
     */
    public function apiCall($endpoint, $verb = 'get', array $data = [], $protected = true, array $headers = [])
    {
        // if endpoint is protected (requires token to access it's functionality)
        if ($protected && !array_has($headers, 'Authorization')) {
            // append the token to the header
            $headers['Authorization'] = 'Bearer ' . $this->getLoggedInTestingUserToken();
        }

        switch ($verb) {
            case 'get':
                $endpoint = $data ? $endpoint . '?' . http_build_query($data) : $endpoint;
                $response = $this->get($endpoint, $headers)->response;
                break;
            case 'post':
            case 'put':
            case 'patch':
            case 'delete':
                $response = $this->{$verb}($endpoint, $data, $headers)->response;
                break;
            case 'json:post':
                $response = $this->json('post', $endpoint, $data, $headers)->response;
                break;
            default:
                throw new UndefinedMethodException('Undefined HTTP Verb (' . $verb . ').');
        }

        return $response;
    }

    /**
     * Inject the ID in the Endpoint URI
     *
     * Example: you give it ('users/{id}/stores', 100) it returns 'users/100/stores'
     *
     * @param        $endpoint
     * @param        $id
     * @param bool   $skipEncoding
     * @param string $replace
     *
     * @return  mixed
     */
    public function injectEndpointId($endpoint, $id, $skipEncoding = false, $replace = '{id}')
    {
        // In case Hash ID is enabled it will encode the ID first
        if (Config::get('hello.hash-id')) {

            if (!$skipEncoding) {
                $id = Hashids::encode($id);
            }
        }

        return str_replace($replace, $id, $endpoint);
    }

    // ---[ RESPONSE MODIFIERS ]----------------------------------------------------------------------------------------

    /**
     * get response object, get the string content from it and convert it to an std object
     * making it easier to read
     *
     * @param $response
     *
     * @return  mixed
     */
    public function getResponseObject(Response $response)
    {
        return json_decode($response->getContent());
    }

    /**
     * @param $response
     *
     * @return  mixed
     */
    private function responseToArray($response)
    {
        if ($response instanceof \Illuminate\Http\Response) {
            $response = json_decode($response->getContent(), true);
        }

        if (array_key_exists('data', $response)) {
            $response = $response['data'];
        }

        return $response;
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

    // ---[ UPLOADER'S ]------------------------------------------------------------------------------------------------

    /**
     * @param        $fileName
     * @param        $stubDirPath
     * @param string $mimeType
     * @param null   $size
     *
     * @return  \Illuminate\Http\UploadedFile
     */
    public function getTestingFile($fileName, $stubDirPath, $mimeType = 'text/plain', $size = null)
    {
        $file = $stubDirPath . $fileName;

        return new UploadedFile($file, $fileName, $mimeType, $size, null, true); // null = null | $testMode = true
    }

    /**
     * @param        $imageName
     * @param        $stubDirPath
     * @param string $mimeType
     * @param null   $size
     *
     * @return  \Illuminate\Http\UploadedFile
     */
    public function getTestingImage($imageName, $stubDirPath, $mimeType = 'image/jpeg', $size = null)
    {
        return $this->getTestingFile($imageName, $stubDirPath, $mimeType, $size);
    }

    // ---[ CUSTOM ASSERTIONS ]-----------------------------------------------------------------------------------------

    /**
     * @param \Dingo\Api\Http\Response $response
     * @param array                    $messages
     */
    public function assertValidationErrorContain(DingoAPIResponse $response, array $messages)
    {
        $arrayResponse = json_decode($response->getContent());

        foreach ($messages as $key => $value) {
            $this->assertEquals($arrayResponse->errors->{$key}[0], $value);
        }
    }

    /**
     * @param $keys
     * @param $response
     */
    public function assertResponseContainKeys($keys, $response)
    {
        if (!is_array($keys)) {
            $keys = (array)$keys;
        }

        foreach ($keys as $key) {
            $this->assertTrue(array_key_exists($key, $this->responseToArray($response)));
        }
    }

    /**
     * @param $values
     * @param $response
     */
    public function assertResponseContainValues($values, $response)
    {
        if (!is_array($values)) {
            $values = (array)$values;
        }

        foreach ($values as $value) {
            $this->assertTrue(in_array($value, $this->responseToArray($response)));
        }
    }

    /**
     * @param $data
     * @param $response
     */
    public function assertResponseContainKeyValue($data, $response)
    {
        $response = json_encode(LaravelArr::sortRecursive(
            (array)$this->responseToArray($response)
        ));

        foreach (LaravelArr::sortRecursive($data) as $key => $value) {
            $expected = $this->formatToExpectedJson($key, $value);
            $this->assertTrue(LaravelStr::contains($response, $expected),
                "The JSON fragment [ {$expected} ] does not exist in the response [ {$response} ].");
        }
    }

    // ---[ MOCKING ]---------------------------------------------------------------------------------------------------

    /**
     * Mocking helper
     *
     * @param $class
     *
     * @return  \Mockery\MockInterface
     */
    public function mock($class)
    {
        $mock = Mockery::mock($class);
        App::instance($class, $mock);

        return $mock;
    }

}
