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

namespace App\Containers\Welcome\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;

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

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Requests\LoginRequest;
use App\Containers\User\Subtasks\ApiLoginSubtask;
use App\Containers\User\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class Controller extends ApiController
{

    public function loginUser(LoginRequest $request, ApiLoginAction $action)
    {
        $user = $action->run($request['email'], $request['password']);

        return $this->response->item($user, new UserTransformer());
    }

    public function logoutUser(HttpRequest $request, ApiLogoutAction $action)
    {
        $action->run($request->header('authorization'));

        return $this->response->accepted(null, [
            'message' => 'User Logged Out Successfully.',
        ]);
    }

}
```

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
