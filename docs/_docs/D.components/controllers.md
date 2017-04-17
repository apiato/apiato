---
title: "Controllers"
category: "Components"
order: 2
---

### Definition & Principles

Read from the [**Porto SAP Documentation (#Controllers)**](https://github.com/Mahmoudz/Porto#Controllers).

### Rules

- All API Controller MUST extend from `App\Ship\Parents\Controllers\ApiController`.
- All Web Controller MUST extend from `App\Ship\Parents\Controllers\WebController`.
- Controllers should use the function `call` to call Actions. (do not manually inject the Action and invoke the `run`).
- Controllers should pass the Request object to the Action instead of passing data from the request. The Request object is the best class to store the state of the Request during its life cycle.

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
