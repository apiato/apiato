---
title: "Controllers"
category: "Main Components"
order: 2
---

- [Definition & Principles](#definition-principles)
- [Rules](#rules)
- [Folder Structure](#folder-structure)
- [Code Sample](#code-sample)
- [Controller response builder helper functions:](#controller-response-builder-helper-functions)
    + [Some of the functions:](#some-of-the-functions)

<a name="definition-principles"></a>

### Definition & Principles

Read from the [**Porto SAP Documentation (#Controllers)**](https://github.com/Mahmoudz/Porto#Controllers).

<a name="rules"></a>

### Rules

- All API Controller MUST extend from `App\Ship\Parents\Controllers\ApiController`.
- All Web Controller MUST extend from `App\Ship\Parents\Controllers\WebController`.
- Controllers should use the function `call` to call Actions. (do not manually inject the Action and invoke the `run`).
- Controllers should pass the Request object to the Action instead of passing data from the request. The Request object is the best class to store the state of the Request during its life cycle.

<a name="folder-structure"></a>

### Folder Structure

```
 - app
    - Containers
        - {container-name}
            - UI
                - API
                    - Controllers
                        - Controller.php
                - WEB
                    - Controllers
                        - Controller.php
```

<a name="code-sample"></a>

### Code Sample

**User Web Welcome Controller:**

```php
<?php

class Controller extends PortWebController
{

    public function sayWelcome()
    {
        return view('welcome');
    }
}
```

**User API Login Controller:**

```php
<?php

class Controller extends ApiController
{

    /**
     * @param \App\Containers\User\UI\API\Requests\RegisterUserRequest $request
     *
     * @return  mixed
     */
    public function registerUser(RegisterUserRequest $request)
    {
        $user = $this->call(RegisterUserAction::class, [$request]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\DeleteUserRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleteUser(DeleteUserRequest $request)
    {
        $user = $this->call(DeleteUserAction::class, [$request]);

        return $this->deleted($user);
    }

    // ...
}
```

**Notice** we call the Action using `$this->call()` which triggers the `run` function in the Action as well inform the action which UI called it, (`$this->getUI()`) in case you wanna handle the same Action differently based on the UI type.

The second parameter of the `call` function is an array of the Action parameters in order. When you need to pass data to the Action, it's recommended to pass the Request Object as it should be the place that holds the state of your current request.


Refer to the **Magical Call** page for more info and examples on how to use the call function.


**Example: Usage from Routes Endpoint:**

```php
<?php

$router->post('login', [
    'uses' => 'Controller@loginUser',
]);

$router->post('logout', [
    'uses'       => 'Controller@logoutUser',
    'middleware' => [
        'api.auth',
    ],
]);
```


<a name="controller-response-builder-helper-functions"></a>

### Controller response builder helper functions:

Many helper function are there to help you build your response faster, those helpers exist in the `vendor/apiato/core/Traits/ResponseTrait.php`.

<a name="some-of-the-functions"></a>

##### Some of the functions:

**transform**
This is the most useful function which you will be using in most cases.

- First required parameter accespts data as object or Collection of objects.
- Second required parameter is the transformer object
- Third optional parameter take the includes that should be returned by the response, _($availableIncludes and $defaultIncludes in the transformer class)_.  
- Fourth optional parameter accepts meta data to be injected in the response.

```php
// $user is a User Object
return $this->transform($user, UserTransformer::class);

// $orders is a Collection of Order Objects
return $this->transform($orders, OrderTransformer::class, ['products', 'recipients', 'store', 'invoice']);
```

**withMeta**
This function allows including meta data in the response.

```php
$metaData = ['total_credits', 10000];

return $this->withMeta($metaData)->transform($receipt, ReceiptTransformer::class);
```


**json**
This function allows passing array data to be represented as json.

```php
return $this->json([
    'foo': 'bar'
]);
```

**Other functions**

- accepted
- deleted
- noContent
- // Some functions might not be documented, so refer to the `vendor/apiato/core/Traits/ResponseTrait.php` and see the public functions.
