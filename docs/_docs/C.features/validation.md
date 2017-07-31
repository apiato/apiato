---
title: "Validation"
category: "Features"
order: 100
---

apiato uses the powerful [Laravel validation](https://laravel.com/docs/validation) system.

But in apiato validation must be defined in the Requests components, since every request might have different rules.

And the Validations rules are automatically applied, once injecting the Request in the Controller.

**Example Request with Validation rules:**

```php
<?php

namespace App\Containers\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class RegisterUserRequest extends Request
{
    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'email'    => 'required|email|max:200|unique:users,email',
            'password' => 'required|min:20|max:300',
            'name'     => 'required|min:2|max:400',
        ];
    }

}
```

**Usage from Controller Example:**

```php
    public function registerUser(RegisterUserRequest $request, CreateUserAction $action)
    {
        $user = $action->run(
            $request['email'],
            $request['password'],
            $request['name'],
            $request['gender'],
            $request['birth']
        );

        return $this->transform($user, UserTransformer::class);
    }
```


## Responses

Validation Error response format:

Single Field:

```json
{
  "errors": {
    "email": [
      "The email has already been taken."
    ]
  },
  "status_code": 422,
  "message": "The given data failed to pass validation."
}
```

Multiple Fields:

```json
{
  "errors": {
    "email": [
      "The email field is required."
    ],
    "password": [
      "The password field is required."
    ]
  },
  "status_code": 422,
  "message": "The given data failed to pass validation."
}
```


More details about requests in the "Request Page".

