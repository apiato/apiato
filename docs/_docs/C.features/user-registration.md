---
title: "User Registration"
category: "Features"
order: 4
---

### Register Users by credentials

To register a User using credentials (email and password), 

You just need to call the `http://api.apiato.dev/register` endpoint (you can find it's documentation after generating the API Doc at `http://apiato.dev/api/private/documentation/#api-Users-registerUser`).

Check out the `registerUser` endpoint in the API Routes files (`app/Containers/User/UI/API/Routes/RegisterUser.v1.private.php`).

This will automatically login the registered User and generates him a Token to be returned with the response.

## Disable auto login

If you don't want to login the User after registration

Go to `app/Containers/User/UI/API/Controllers/Controller.php` and set the last parameter in the Action to false. 

Example:

```php
<?php

public function registerUser(RegisterRequest $request, RegisterUserAction $action)
{
    $user = $action->run(
        $request['email'],
        $request['password'],
        $request['name'],
        true // << default to true means login after you register.
    );

    return $this->response->item($user, new UserTransformer());
} 
```

## Register with Social Account

> (Facebook, Twitter, Google..)

Checkout the [Social Authentication](doc:social-authentication) Page for how to Sign up with Social Account.
