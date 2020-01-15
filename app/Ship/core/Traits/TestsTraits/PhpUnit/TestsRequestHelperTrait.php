<?php

namespace Apiato\Core\Traits\TestsTraits\PhpUnit;

use Illuminate\Support\Arr;
use App;
use App\Ship\Exceptions\MissingTestEndpointException;
use App\Ship\Exceptions\UndefinedMethodException;
use App\Ship\Exceptions\WrongEndpointFormatException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class TestsRequestHelperTrait
 *
 * Tests helper for making HTTP requests.
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait TestsRequestHelperTrait
{

    /**
     * property to be set on the user test class
     *
     * @var  string
     */
    protected $endpoint = '';

    /**
     * property to be set on the user test class
     *
     * @var  bool
     */
    protected $auth = true;

    /**
     * Http response
     *
     * @var  \Illuminate\Foundation\Testing\TestResponse
     */
    protected $response;

    /**
     * @var string
     */
    protected $responseContent;

    /**
     * @var array
     */
    protected $responseContentArray;

    /**
     * @var \stdClass
     */
    protected $responseContentObject;

    /**
     * Allows users to override the default class property `endpoint` directly before calling the `makeCall` function.
     *
     * @var string
     */
    protected $overrideEndpoint;

    /**
     * Allows users to override the default class property `auth` directly before calling the `makeCall` function.
     *
     * @var string
     */
    protected $overrideAuth;

    /**
     * @param array $data
     * @param array $headers
     *
     * @throws \App\Ship\Exceptions\UndefinedMethodException
     * 
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function makeCall(array $data = [], array $headers = [])
    {
        // Get or create a testing user. It will get your existing user if you already called this function from your
        // test. Or create one if you never called this function from your tests "Only if the endpoint is protected".
        $this->getTestingUser();

        // read the $endpoint property from the test and set the verb and the uri as properties on this trait
        $endpoint = $this->parseEndpoint();
        $verb = $endpoint['verb'];
        $url = $endpoint['url'];

        // validating user http verb input + converting `get` data to query parameter
        switch ($verb) {
            case 'get':
                $url = $this->dataArrayToQueryParam($data, $url);
                break;
            case 'post':
            case 'put':
            case 'patch':
            case 'delete':
                break;
            default:
                throw new UndefinedMethodException('Unsupported HTTP Verb (' . $verb . ')!');
        }

        $httpResponse = $this->json($verb, $url, $data, $headers);

        return $this->setResponseObjectAndContent($httpResponse);
    }

    /**
     * @param $httpResponse
     *
     * @return  \Illuminate\Foundation\Testing\TestResponse
     */
    public function setResponseObjectAndContent($httpResponse)
    {
        $this->setResponseContent($httpResponse);

        return $this->response = $httpResponse;
    }

    /**
     * @param $httpResponse
     *
     * @return  mixed
     */
    public function setResponseContent($httpResponse)
    {
        return $this->responseContent = $httpResponse->getContent();
    }

    /**
     * @return  string
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }

    /**
     * @return  mixed
     */
    public function getResponseContentArray()
    {
        return $this->responseContentArray ? : $this->responseContentArray = json_decode($this->getResponseContent(),
            true);
    }

    /**
     * @return  mixed
     */
    public function getResponseContentObject()
    {
        return $this->responseContentObject ? : $this->responseContentObject = json_decode($this->getResponseContent(),
            false);
    }

    /**
     * Inject the ID in the Endpoint URI before making the call by
     * overriding the `$this->endpoint` property
     *
     * Example: you give it ('users/{id}/stores', 100) it returns 'users/100/stores'
     *
     * @param        $id
     * @param bool   $skipEncoding
     * @param string $replace
     *
     * @return  $this
     */
    public function injectId($id, $skipEncoding = false, $replace = '{id}')
    {
        // In case Hash ID is enabled it will encode the ID first
        $id = $this->hashEndpointId($id, $skipEncoding);
        $this->endpoint = str_replace($replace, $id, $this->endpoint);

        return $this;
    }

    /**
     * Override the default class endpoint property before making the call
     *
     * to be used as follow: $this->endpoint('verb@uri')->makeCall($data);
     *
     * @param $endpoint
     *
     * @return  $this
     */
    public function endpoint($endpoint)
    {
        $this->overrideEndpoint = $endpoint;

        return $this;
    }

    /**
     * @return  string
     */
    public function getEndpoint()
    {
        return !is_null($this->overrideEndpoint) ? $this->overrideEndpoint : $this->endpoint;
    }

    /**
     * Override the default class auth property before making the call
     *
     * to be used as follow: $this->auth('false')->makeCall($data);
     *
     * @param bool $auth
     *
     * @return  $this
     */
    public function auth(bool $auth)
    {
        $this->overrideAuth = $auth;

        return $this;
    }

    /**
     * @return  bool
     */
    public function getAuth()
    {
        return !is_null($this->overrideAuth) ? $this->overrideAuth : $this->auth;
    }

    /**
     * @param $uri
     *
     * @return  string
     */
    private function buildUrlForUri($uri)
    {
        // add `/` at the beginning in case it doesn't exist
        if (!Str::startsWith($uri, '/')) {
            $uri = '/' . $uri;
        }

        return Config::get('apiato.api.url') . $uri;
    }

    /**
     * Attach Authorization Bearer Token to the request headers
     * if it does not exist already and the authentication is required
     * for the endpoint `$this->auth = true`.
     *
     * @param $headers
     *
     * @return  mixed
     */
    private function injectAccessToken(array $headers = [])
    {
        // if endpoint is protected (requires token to access it's functionality)
        if ($this->getAuth() && !$this->headersContainAuthorization($headers)) {
            // append the token to the header
            $headers['Authorization'] = 'Bearer ' . $this->getTestingUser()->token;
        }

        return $headers;
    }

    /**
     * just check if headers array has an `Authorization` as key.
     *
     * @param $headers
     *
     * @return  bool
     */
    private function headersContainAuthorization($headers)
    {
        return Arr::has($headers, 'Authorization');
    }

    /**
     * @param $data
     * @param $url
     *
     * @return  string
     */
    private function dataArrayToQueryParam($data, $url)
    {
        return $data ? $url . '?' . http_build_query($data) : $url;
    }

    /**
     * @param $text
     *
     * @return  string
     */
    private function getJsonVerb($text)
    {
        return Str::replaceFirst('json:', '', $text);
    }


    /**
     * @param      $id
     * @param bool $skipEncoding
     *
     * @return  mixed
     */
    private function hashEndpointId($id, $skipEncoding = false)
    {
        return (Config::get('apiato.hash-id') && !$skipEncoding) ? Hashids::encode($id) : $id;
    }

    /**
     * read `$this->endpoint` property from the test class (`verb@uri`) and convert it to usable data
     *
     * @return  array
     */
    private function parseEndpoint()
    {
        $this->validateEndpointExist();

        $separator = '@';

        $this->validateEndpointFormat($separator);

        // convert the string to array
        $asArray = explode($separator, $this->getEndpoint(), 2);

        // get the verb and uri values from the array
        extract(array_combine(['verb', 'uri'], $asArray));
        /** @var TYPE_NAME $verb */
        /** @var TYPE_NAME $uri */

        return [
            'verb' => $verb,
            'uri'  => $uri,
            'url'  => $this->buildUrlForUri($uri),
        ];
    }

    /**
     * @void
     */
    private function validateEndpointExist()
    {
        if (!$this->getEndpoint()) {
            throw new MissingTestEndpointException();
        }
    }

    /**
     * @param $separator
     *
     * @throws WrongEndpointFormatException
     */
    private function validateEndpointFormat($separator)
    {
        // check if string contains the separator
        if (!strpos($this->getEndpoint(), $separator)) {
            throw new WrongEndpointFormatException();
        }
    }

    /**
     * Transform headers array to array of $_SERVER vars with HTTP_* format.
     *
     * @param  array $headers
     *
     * @return array
     */
    protected function transformHeadersToServerVars(array $headers)
    {
        return collect($headers)->mapWithKeys(function ($value, $name) {
            $name = strtr(strtoupper($name), '-', '_');

            return [$this->formatServerHeaderKey($name) => $value];
        })->all();
    }

}
