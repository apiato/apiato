<?php

namespace Mega\Services\Core\Test\Traits;

use App;
use Illuminate\Support\Arr as LaravelArr;
use Illuminate\Support\Str as LaravelStr;
use Mega\Modules\User\Tasks\CreateUserTask;
use Symfony\Component\Debug\Exception\UndefinedMethodException;

/**
 * Class TestingTrait.
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
     * @param           $endpoint
     * @param string    $verb
     * @param array     $data
     * @param bool|true $protected
     * @param array     $header
     *
     * @return mixed
     *
     * @throws \Symfony\Component\Debug\Exception\UndefinedMethodException
     */
    public function apiCall($endpoint, $verb = 'get', $data = [], $protected = true, $header = [])
    {
        $content = json_encode($data);

        $headers = array_merge([
            'CONTENT_LENGTH' => mb_strlen($content, '8bit'),
//            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ], $header);

        // if endpoint is protected (requires token to access it's functionality)
        if ($protected) {
            // append the token to the header
            $headers['Authorization'] = 'Bearer '.$this->getLoggedInTestingUserToken();
        }

        $verb = strtolower($verb);

        switch ($verb) {
            case 'get':
                $response = $this->get($endpoint, $headers)->response;
                break;
            case 'post':
            case 'put':
            case 'patch':
            case 'delete':
                $response = $this->{$verb}($endpoint, $data, $headers)->response;
                break;
            default:
                throw new UndefinedMethodException('Undefined HTTP Verb ('.$verb.').');
        }

        return $response;
    }

    /**
     * @param       $response
     * @param array $messages
     */
    public function assertValidationErrorContain($response, array $messages)
    {
        $arrayResponse = json_decode($response->getContent());

        foreach ($messages as $key => $value) {
            $this->assertEquals($arrayResponse->errors->{$key}[0], $value);
        }
    }

    /**
     * get teh current logged in user.
     *
     * @return \Mega\Infrastructure\Traits\User
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
                'name' => 'Mahmoud Zalt',
                'email' => 'testing@mega.pro',
                'password' => 'secret.Pass7',
            ];
        }

        $createUserTask = App::make(CreateUserTask::class);

        // create new user and login (true)
        $user = $createUserTask->run(
            $userDetails['email'],
            $userDetails['password'],
            $userDetails['name'],
            true
        );

        return $this->loggedInTestingUser = $user;
    }

    /**
     * @param $keys
     * @param $response
     */
    public function assertResponseContainKeys($keys, $response)
    {
        if (!is_array($keys)) {
            $keys = (Array) $keys;
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
            $values = (Array) $values;
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
            (array) $this->responseToArray($response)
        ));

        foreach (LaravelArr::sortRecursive($data) as $key => $value) {
            $expected = $this->formatToExpectedJson($key, $value);
            $this->assertTrue(LaravelStr::contains($response, $expected),
                "The JSON fragment [ {$expected} ] does not exist in the response [ {$response} ].");
        }
    }

    /**
     * Prettify printing JSON data (mainly for API responses) in the terminal.
     *
     * @param $json
     *
     * @return string
     */
    public function ddj($json)
    {
        $result = '';
        $pos = 0;
        $strLen = strlen($json);
        $indentStr = '  ';
        $newLine = "\n";
        $prevChar = '';
        $outOfQuotes = true;

        for ($i = 0; $i <= $strLen; ++$i) {

            // Grab the next character in the string.
            $char = substr($json, $i, 1);

            // Are we inside a quoted string?
            if ($char == '"' && $prevChar != '\\') {
                $outOfQuotes = !$outOfQuotes;

                // If this character is the end of an element,
                // output a new line and indent the next line.
            } else {
                if (($char == '}' || $char == ']') && $outOfQuotes) {
                    $result .= $newLine;
                    --$pos;
                    for ($j = 0; $j < $pos; ++$j) {
                        $result .= $indentStr;
                    }
                }
            }

            // Add the character to the result string.
            $result .= $char;

            // If the last character was the beginning of an element,
            // output a new line and indent the next line.
            if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
                $result .= $newLine;
                if ($char == '{' || $char == '[') {
                    ++$pos;
                }

                for ($j = 0; $j < $pos; ++$j) {
                    $result .= $indentStr;
                }
            }

            $prevChar = $char;
        }

        dd($result);
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
}
