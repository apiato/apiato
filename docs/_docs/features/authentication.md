---
title: "Authentication"
category: "Features"
order: 3
---

In apiato, middlewares are the best solution to apply Authentication in your App.

in **APIATO** you can use these two `Authentication Middlewares`, to protect your endpoints:

- API Authentication: `auth:api`
- Web Authentication: `auth:web`


## API Authentication (OAuth 2.0)

To protect an **API** Endpoint from being accessible by unauthenticated users you can use the `auth:api` Middleware.

```php
<?php

$router->get('secret/info', [
    'uses'       => 'Controller@getSecretInfo',
    'middleware' => [
        'auth:api',
    ],
]);

```

All Endpoints protected with `auth:api` are accessible only when sending them a valid access token.

This Middleware is provided by the [Laravel Passport](https://laravel.com/docs/passport) package. So you can read its documentation for more details.



### How to get Access Token using OAuth 2.0

> The Auth Endpoints and more, are documented by default in APIATO. Go to [Documentation Generator Page]({{ site.baseurl }}{% link _docs/features/api-docs-generator.md %}) and see how to generate the API documentation.


OAuth let's you authenticate using different methods, these methods are called `grants`.
How to decide which grant type you should use! Check [this](https://oauth2.thephpleague.com/authorization-server/which-grant/), and keep reading this documentation.


<br>

### A: For first-party clients

First-party clients like your Frontend Mobile, Web,... Apps. That usually consumes your private API (Internal API).

For this w'll use the **Resource owner credentials grant** (A.K.A Password Grant Tokens).

With this grant type your server needs to authenticate the Client App first (ensuring the request is coming from your trusted frontend App) and your User credentials are correct (ensuring the user is registered and has the right access), before issuing an access token.


**How it works:**

> Quick Overview:
> - On register: the API returns user data. You will need to log that user in (using the same credentials he passed) to get his Access Token and make other API calls.
> - On login: the API returns the user Access Token with Refresh Token. You will need to request the User data by making another call to the user endpoint, using his Access Token.


1) Create a password type Client in your database to represent your App. you can use `php artisan passport:client --password`.

2) Your user enters his (username + password) in your App login screen (assuming he registered already).

3) Your Client App sends a **Post** request to `http://api.apiato.dev/v1/oauth/token` containing the user credentials (`username` and `password`) and the client credentials (`client_id` and `client_secret`) in addition to the `scope` and `grant_type=password`:

Request:

```shell
curl --request POST \
  --url http://api.apiato.dev/v1/oauth/token \
  --header 'accept: application/json' \
  --header 'content-type: application/x-www-form-urlencoded' \
  --data 'username=admin%40admin.com&password=admin&client_id=2&client_secret=SGUVv02b1ppQCgI7ZVeoTZDN6z8SSFLYiMOzzfiE&grant_type=password&scope='
```

Response:

```json
{
  "token_type": "Bearer",
  "expires_in": 31536000,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUz...",
  "refresh_token": "TPSPA1S6H8Wydjkjl+xt+hPGWTagL..."
}
```

4) Your Client App should save the Tokens and start requesting secure data, by sending the Access Token in the HTTP Header `Authorization = Bearer {Access-Token}`.

More info at [Laravel Passport Here](https://laravel.com/docs/5.4/passport#password-grant-tokens)

> WARNING: the Client ID and Secret should not be stored in JavaScript or browser cache, or made accessible in any way.

So in case of Web Apps (JavaScript) you need to hide your client credentials behind a proxy. And APIATO by default provides you with a Login Proxy to use for all your trusted first party clients.

### Login Proxy

Concept: create endpoint for each trusted client, to be used for login. APIATO by default has this url `clients/web/admin/login`, but you can add more as you need for each of your trusted first party clients apps (example: `clients/web/users/login`, `clients/mobile/users/login`).

That endpoint should append the corresponding client ID and Secret to your request and make another call to your Auth server with all the required data.
Then it returns the Auth response back to the client with the Tokens in it.

Note: You have to manually extract the Client credentials from the DB after running `passport:install` and put them in the `.env`.

Example:
```
CLIENT_WEB_ADMIN_ID=2
CLIENT_WEB_ADMIN_SECRET=VkjYCUk5DUexJTE9yFAakytWCOqbShLgu9Ql67TI
```

## Login

Login from your App by sending a POST request to `http://api.apiato.dev/v1/oauth/token` with `grant_type=password` in addition to the User and Client Credentials, to get the user Access Token. Once issued, you can use that Access Token to make requests to protected resources (Endpoints).

The Access Token should be sent in the `Authorization` header of type `Bearer` Example: `Authorization = Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUz...`

**Keep in mind there's no session state when using Tokens for Authentication**


## Force Email Confirmation

By default a user doesn't have to confirm his email address to be able to login.
However, to force users to confirm their email (prevent unconfirmed users from accessing the site), you can set
`'require_email_confirmation' => true,` in `App\Containers\Authentication\Configs\authentication.php`. 

When email confirmation is enabled (value set to `true`), the API throws an exception, if the `User` is not yet `confirmed`.


## Logout

Logout by sending a POST request to `http://api.apiato.dev/v1/logout/` containing the Token in the Header.

```json
{
  "message": "Token revoked successfully."
}
```

### B: For third-party clients

Third party clients like your User's custom external Apps, who wants to integrate with your Software. That usually consumes your public API (External API).

For this w'll use the **Client credentials grant** (A.K.A Personal Access Tokens). *This grant type is the simplest and is suitable for machine-to-machine authentication.*

With this grant type your server needs to authenticate the Client App only, before issuing an access token.

**How it works**

1) User logs in to your App, go to settings, create Client (of type `personal`) and copy the ID and Secret. *(Note this can be done via an API if you prefer)*

You may generate a personal client for testing purposes using `php artisan passport:client --personal`.

2) User add the Client credentials to his "Server Side software" and send a **Post** request to `http://api.apiato.dev/v1/oauth/token` containing the Client credentials (`client_id` and `client_secret`) in addition to the `scope` and `grant_type=client_credentials`:

Request:

```shell
curl --request POST \
  --url http://api.apiato.dev/v1/oauth/token \
  --header 'accept: application/json' \
  --header 'content-type: application/x-www-form-urlencoded' \
  --data 'client_id=1&client_secret=y1RbtnOvh9rpA91zPI2tiVKmFlepNy9dhHkzUKle&grant_type=client_credentials&scope='
```

Response:

```json
{
  "token_type": "Bearer",
  "expires_in": 31536000,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1Ni..."
}
```

3) The Client will be granted an Access Token to be saved. Then the Client can start requesting secure data, by sending the Access Token in the HTTP Header `Authorization = Bearer {Access-Token}`.

Note: When a new user is registered, will be issued a personal Access Token automatically. Check the User "Registration page".

More info at [Laravel Passport Here](https://laravel.com/docs/5.4/passport#personal-access-tokens)


## Responses


**Authentication failed JSON response:**

```json
{
  "errors": "Missing or invalid Access Token!",
  "status_code": 403,
  "message": "Unauthenticated."
}
```

**Wrong Client ID or Secret:**

```json
{
  "error": "invalid_client",
  "message": "Client authentication failed"
}
```

## Change Tokens Expiration dates

Go to the `app/Ship/Configs/apiato.php` config file and edit this:

```php
<?php

/*
|--------------------------------------------------------------------------
| Access Token Expiration
|--------------------------------------------------------------------------
|
| In Days. Default to 3650 days = 10 years
|
*/
'expires-in' => env('API_TOKEN_EXPIRES', 3650),

/*
|--------------------------------------------------------------------------
| Refresh Token Expiration
|--------------------------------------------------------------------------
|
| In Days. Default to 3650 days = 10 years
|
*/
'refresh-expires-in' => env('API_REFRESH_TOKEN_EXPIRES', 3650),
```

To change from days to minutes you need to edit the `boot` function in `App\Containers\Authentication\Providers\AuthProvider`.

## Web Authentication

To protect an **Web** Endpoint from being accessible by unauthenticated users you can use the `auth:web` Middleware.

Example:

```php
<?php

$router->get('private/page', [
    'uses'       => 'Controller@showPrivatePage',
    'middleware' => [
        'auth:web',
    ],
]);
```

This Middleware is provided by apiato and is different than the default Laravel Auth Middleware.

**If authentication failed, users will be redirected to a login page**

To change the login page view go to the config file `app/Ship/Configs/apiato.php`, and set the name of your login page there as follow:

```php
<?php

/*
|--------------------------------------------------------------------------
| The Login Page URL
|--------------------------------------------------------------------------
*/

'login-page-url' => 'login',
```

This will be looking for (login.html or login.php or login.blade.php).


## Social Authentication

For Social Authentication visit the [Social Authentication]({{ site.baseurl }}{% link _docs/features/social-authentication.md %}) page.
