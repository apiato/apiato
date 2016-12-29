<?php

namespace App\Port\Tests\PHPUnit\Traits;

use App;
use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tasks\AssignRoleTask;
use App\Containers\User\Actions\CreateUserAction;
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
     * get teh current logged in user.
     *
     * @return \App\Port\Tests\PHPUnit\Traits\User|mixed
     */
    public function getLoggedInTestingUser()
    {
        $user = $this->loggedInTestingUser;

        if (!$user) {
            $user = $this->registerAndLoginTestingUser();
        }

        return $user;
    }

    /**
     * This returned visitor is a normal user, with `visitor_id` means
     * before he became a registered user (can login) was a visitor.
     * So this can be used to test endpoints that are protected by visitors
     * access.
     *
     * @return  \App\Port\Tests\PHPUnit\Traits\User|mixed
     */
    public function getVisitor()
    {
        $user = $this->getLoggedInTestingUser();

        $user->visitor_id = str_random('20');
        unset($user->token);
        $user->save();

        return $user;
    }

    /**
     * @return  \App\Port\Tests\PHPUnit\Traits\User|mixed
     */
    public function getLoggedInTestingAdmin()
    {
        $user = $this->getLoggedInTestingUser();

        $user = $this->makeAdmin($user);

        return $user;
    }

    /**
     * @param $user
     *
     * @return  mixed
     */
    public function makeAdmin($user)
    {
        $adminRole = Role::where('name', 'admin')->first();

        $user->assignRole($adminRole);

        return $user;
    }

    /**
     * get teh current logged in user token.
     *
     * @return string
     */
    public function getLoggedInTestingUserToken()
    {
        return $this->getLoggedInTestingUser()->token;
    }

    /**
     * @param null $userDetails
     *
     * @return mixed
     */
    public function registerAndLoginTestingUser($userDetails = null)
    {
        // if no user detail provided, use the default details.
        if (!$userDetails) {
            $userDetails = [
                'name'     => 'Mahmoud Zalt',
                'email'    => 'testing@hello.dev',
                'password' => 'secret.Pass7',
            ];
        }

        $createUserAction = App::make(CreateUserAction::class);

        // create new user and login (true)
        $user = $createUserAction->run(
            $userDetails['email'],
            $userDetails['password'],
            $userDetails['name'],
            null,
            null,
            true
        );

        return $this->loggedInTestingUser = $user;
    }

    /**
     * @param null $userDetails
     *
     * @return  mixed
     */
    public function registerAndLoginTestingAdmin($userDetails = null)
    {
        $user = $this->registerAndLoginTestingUser($userDetails);

        $user = $this->makeAdmin($user);

        return $user;
    }

    /**
     * Normal user with Developer Role
     *
     * @param null $userDetails
     *
     * @return  mixed
     */
    public function registerAndLoginTestingDeveloper($userDetails = null)
    {
        $user = $this->registerAndLoginTestingUser($userDetails);

        // Give Developer Role to this User if he doesn't have it already
        if (!$user->hasRole('developer')) {
            App::make(AssignRoleTask::class)->run($user, ['developer']);
        }

        return $user;
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
        \Artisan::call('migrate');
    }

    /**
     * @param $response
     *
     * @return mixed
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
     * Make sure you have an image in `storage/tests/` named to `a.jpeg` or anything else
     *
     * @param string $original_name
     * @param string $mime_type
     * @param int    $size
     *
     * @return  \Illuminate\Http\UploadedFile
     */
    public static function getTestingFile($original_name = 'a.jpeg', $mime_type = 'image/jpeg', $size = 2476)
    {
        $path = storage_path('tests/' . $original_name);
        $error = null;
        $test = true;

        $file = new UploadedFile($path, $original_name, $mime_type, $size, $error, $test);

        return $file;
    }

    /**
     * Create Application in the database with Token based on the User who made the request.
     * And return headers array with the Application stored token in it.
     * This is made to be used with the endpoints protected with `app.auth` middleware.
     *
     * @param string $endpoint
     * @param string $verb
     * @param array  $data
     */
    public function getApplicationTokenHeader(
        $endpoint = 'apps/',
        $verb = 'post',
        $data = ['name' => 'Testing Application']
    ) {
        $application = $this->apiCall($endpoint, $verb, $data);

        //TODO: remove dependency data->token depend of the Authorization container transformer response of the App
        // override the header with the application token instead of the default user token
        $headers['Authorization'] = 'Bearer ' . $this->getResponseObject($application)->data->token;

        return $headers;
    }

    /**
     * override default URL subDomain in case you want to change it for some tests
     *
     * @param $subDomain
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
