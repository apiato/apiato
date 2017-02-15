<?php

namespace App\Port\Test\PHPUnit\Traits;

use App;
use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
use App\Containers\User\Models\User;
use Artisan;
use Dingo\Api\Http\Response as DingoAPIResponse;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr as LaravelArr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str as LaravelStr;
use Mockery;
use Symfony\Component\Debug\Exception\UndefinedMethodException;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class TestingTrait.
 *
 * All the functions in this trait are accessible from all your tests.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait TestingTrait
{

    /**
     * the Logged in user, used for protected routes.
     *
     * @var User
     */
    public $loggedInTestingUser;

    public $loggedInTestingAdmin;

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

    /**
     * get teh current logged in user OR create new one if no one exist
     *
     * @param null $access
     *
     * @return  \App\Containers\User\Models\User|mixed
     */
    public function getTestingUser($access = null)
    {
        if (!$user = $this->loggedInTestingUser) {
            $user = $this->createTestingUser($access);
        }

        return $user;
    }

    /**
     * @return  \App\Containers\User\Models\User|mixed
     */
    public function getTestingUserWithoutPermissions()
    {
        if (!$user = $this->loggedInTestingUser) {
            $user = $this->getTestingUser(['permissions' => null, 'roles' => null]);
        }

        return $user;
    }

    /**
     * @param null $permissions
     *
     * @return  \App\Containers\User\Models\User|mixed
     */
    public function getTestingAdmin($permissions = null)
    {
        if (!$admin = $this->loggedInTestingAdmin) {
            $admin = $this->loggedInTestingAdmin = $this->createTestingUser([
                'roles'       => 'admin',
                'permissions' => $permissions,
            ]);
        }

        return $admin;
    }

    /**
     * get teh current logged in user token.
     *
     * @return string
     */
    public function getLoggedInTestingUserToken()
    {
        return $this->getTestingUser()->token;
    }

    /**
     * @param null $access
     * @param null $userDetails
     *
     * @return  mixed
     */
    public function createTestingUser($access = null, $userDetails = null)
    {

        // if no user detail provided, use the default details.
        $userDetails = $userDetails ? : [
            'name'     => 'Testing User',
            'email'    => $this->faker->email,
            'password' => 'testing-pass',
        ];

        // create new user and login
        $user = factory(User::class)->create([
            'email'    => $userDetails['email'],
            'password' => Hash::make($userDetails['password']),
            'name'     => $userDetails['name'],
        ]);

        // assign roles and permissions
        $user = $this->setupTestingUserAccess($user, $access ? : (isset($this->access) ? $this->access : null));

        // log the user in
        $user = App::make(ApiLoginThisUserObjectTask::class)->run($user);

        return $this->loggedInTestingUser = $user;
    }

    /**
     * @param $user
     * @param $access
     *
     * @return  mixed
     */
    private function setupTestingUserAccess($user, $access)
    {
        if (isset($access['permissions']) && !empty($access['permissions'])) {
            $user->givePermissionTo($access['permissions']);
        }
        if (isset($access['roles']) && !empty($access['roles'])) {
            if (!$user->hasRole($access['roles'])) {
                $user->assignRole($access['roles']);
            }
        }

        return $user;
    }

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

    /**
     * Migrate the database.
     */
    public function migrateDatabase()
    {
        Artisan::call('migrate');
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
     * Inject the ID in the Endpoint URI
     *
     * Example: you give it ('users/{id}/stores', 100) it returns 'users/100/stores'
     *
     * @param      $endpoint
     * @param      $id
     * @param bool $skipEncoding
     *
     * @return  mixed
     */
    public function injectEndpointId($endpoint, $id, $skipEncoding = false)
    {

        // In case Hash ID is enabled it will encode the ID first
        if (Config::get('hello.hash-id')) {

            if (!$skipEncoding) {
                $id = Hashids::encode($id);
            }
        }

        return str_replace("{id}", $id, $endpoint);
    }

    /**
     * override default URL subDomain in case you want to change it for some tests
     *
     * @param      $subDomain
     * @param null $url
     */
    public function overrideSubDomain($subDomain, $url = null)
    {
        $url = ($url) ? : $this->baseUrl;

        $info = parse_url($url);

        $array = explode('.', $info['host']);

        $withoutDomain = (array_key_exists(count($array) - 2,
                $array) ? $array[count($array) - 2] : '') . '.' . $array[count($array) - 1];

        $newSubDomain = $info['scheme'] . '://' . $subDomain . '.' . $withoutDomain;

        $this->baseUrl = $newSubDomain;
    }

}
