---
title: "Tests Helpers"
category: "Miscellaneous"
order: 2
---

- [Tests properties](#tests-properties)
    - [$endpoint](#endpoint)
    - [$auth](#auth)
    - [$access](#access)
- [Tests functions](#tests-functions)
    - [makeCall](#makecall)
    - [getTestingUser](#gettestinguser)
- [Faker](#faker)
- [Create live Testing Data](#create-live-testing-data)

<br>
<br>
apiato is built on top of the [Laravel's default Tests](https://laravel.com/docs/5.4/http-tests), and provides some
awesome helper functions, for faster and more enjoyable testing experience.

With apiato you just prepare the data you want to send, make a the call with single function and start asserting the
response. Everything else is set for you.


<a name="tests-properties"></a>

## Tests properties

Some of the test helper functions reads your test class properties, to perform their jobs. below we will see those
properties and who uses them:

<a name="endpoint"></a>

### **$endpoint**:

The `$endpoint = 'verb@uri';` property is where you define the endpoints you are trying to access when calling
`$this->makeCall()`.

**Example:**

```php
<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Containers\User\Tests\TestCase;

class RegisterUserTest extends TestCase
{

    protected $endpoint = 'post@register';

    protected $auth = false;

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testRegisterNewUserWithCredentials_()
    {
        // prepare your post data
        $data = [
            'email'    => 'hello@mail.dev',
            'name'     => 'Mahmoud',
            'password' => 'secret',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        // ... add all your assertions
    }

}
```


<a name="override-the-property-value-in-some-test-functions"></a>

#### Override the property value in some test functions

```php

$response = $this->endpoint('get@myEndpoint')->makeCall();

```

<a name="auth"></a>

### **$auth**:

The `$auth = false;` property defines if the endpoint you are trying to call requires authentication or not. By default
`$auth` is equal to true, also when not defined on your test class it will be default to true.

When `$auth` is true, the `makeCall()` will create a testing user if no one already found, and it will inject his
access token in the headers, before making the call.

So only use this property when your endpoint is not protected, example for the register and login tests.

<a name="override-the-property-value-in-some-test-functions-1"></a>

#### Override the property value in some test functions

```php

$response = $this->auth(false)->makeCall();

```

<a name="access"></a>

### **$access**:

The `$access` property is where you define the permissions/roles that you need to give to your testing users in that
test class. So when using `$user = $this->getTestingUser();` it will automatically takes all the roles and permissions
you gave him.

```php
<?php

    protected $access = [

        'roles'         => 'admin', // or   ['client', 'admin']

        'permissions'   => 'delete-users',

    ];

```

<a name="override-the-property-value-in-some-test-functions-2"></a>

#### Override the property value in some test functions

Call the `getTestingUser` and pass whichever roles and permissions to him.

```php

$this->getTestingUser(['permissions' => 'jump', 'roles' => 'jumper']);

```

Or you can call `getTestingUserWithoutAccess()` to get user without permissions and roles.

<a name="tests-functions"></a>

## Tests functions

All the test helper functions are provided by traits classes living inside `app/Ship/Tests/*` folder. And they are all
available for usage from every test class in your application.

<a name="makeCall"></a>

#### makeCall

`makeCall(array $data = [], array $headers = [])` is one of the most important helper functions for an API.

**Usage:**

```php
<?php

$response = $this->makeCall();

$response = $this->makeCall([

    'email'    => $userDetails['email'],

    'password' => $userDetails['password'],

]);

$response = $this->makeCall($data, $headers);

$response = $this->endpoint('get@register')->makeCall($data);

$response = $this->auth(false)->makeCall();

$response = $this->endpoint('get@item/{id}')->injectId($user->id)->makeCall();

```

<a name="gettestinguser"></a>

#### getTestingUser

`getTestingUser($userDetails = null, $access = null)` is another very important helper function:

**Usage:**

```php
<?php

$user = $this->getTestingUser();

$user = $this->getTestingUser([
    'email'    => 'hello@mail.dev',
    'name'     => 'Hello',
    'password' => 'secret',
]);

```

> **NOTE:** Later all the test helper functions will be documented, meanwhile to see all the available functions  
check all the public functions in all the traits in this directory `vendor/apiato/core/Traits/TestsTraits/PhpUnit/*`.




<a name="faker"></a>

## Faker

Just use it from any test: `$this->faker->name;`

There's an instance of faker in every class.

Just use it: `$this->faker->name;`

See the [Tests]({{ site.baseurl }}{% link _docs/components/tests.md %}) Page, for more details about the Tests components.



<a name="create-live-testing-data"></a>

## Create live Testing Data

To test your app with some live testing data (like creating items in an inventory) you can use this feature to
automatically genereate those data. This is also helpful for staging when real people are testing your app with some testing data.

1. Go to `Seeder/SeedTestingData.php` seeder class, and create your live testing data.

2. Run this command `php artisan apiato:seed-test`
