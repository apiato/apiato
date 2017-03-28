---
title: "Authentication"
category: "Features"
order: 2
---

Middlewares are the best way to apply Authentication to your App. 

Hellp Api provides 2 Authentication Middlewares:

- API Authentication Middlewares.  

**api.auth**: provided by the Dingo Package 

(Dingo\Api\Http\Middleware\Auth).

- Web Authentication Middlewares.  

**web.auth**: provided by apiato

(App\Containers\Authentication\Middlewares\Authentication).

## API Authentication

To make an Endpoint accessible by Authenticated Users you should use the `api.auth` Middleware on your Endpoint. 

Example:

```php
<?php

$router->get('secret/docs', [

    'uses'       => 'Controller@getSecretDocs',

    'middleware' => [

        'api.auth',

    ],

]);

```

The `api.auth` should be used for all the Endpoints requiring the user to be logged in. So the Endpoint protected with `api.auth` requires the user to send his token with the request. It will automatically login the user and attach its object to the request and making it accessible in the entire App.

This Middleware is provided by the [dingo/api](https://github.com/dingo/api) package. So you can read its documentation for more details. 

**If authentication failed, users will get a JSON response:**

```php
<?php

{
  "message": "Failed to authenticate because of bad credentials or an invalid authorization header.",
  "status_code": 401
}

```

## Web Authentication

To make a web page accessible by Authenticated Users you should use the `web.auth` Middleware on your Endpoint. 

Example:

```pjp
<?php

$router->get('private/page', [
    'uses'       => 'Controller@showPrivatePage',
    'middleware' => [
        'web.auth',
    ],

]);

```

This Middleware is provided by apiato and is different than the default Laravel Auth Middleware.

**If authentication failed, users will be redirected to a login page**

To change the login page view go to the config file `app/Ship/Features/Configs/hello.php`, and set the name of your login page there as follow:

```php
<?php

  'login-page-name' => 'login',
```

This will be looking for (login.html or login.php or login.blade.php).

## Social Authentication

For Social Authentication visit the [Social Authentication](http://apiato.io/C.features/social-authentication/) page.
