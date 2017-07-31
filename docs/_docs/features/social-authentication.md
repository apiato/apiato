---
title: "Social Authentication"
category: "Features"
order: 6
---

For Social Authentication apiato uses [Socialite]( https://github.com/laravel/socialite).

## How Social Authentication work

1. The Client (Mobile/Web) sends a request to the Auth Provider (Facebook, Twitter,...) 

2. The Auth Provider returns a Code (Auth Token)

3. The Client makes a call to the server (our server) passing the Code retrieved from the Provider.

4. The Server fetches the user data from the Auth Provider using the received Code.

5. The Server create or return the Authenticated User.

## Default Supported Auth Provide

* Facebook
* Twitter
* Google Plus

## Support new Auth Provide

1) Check the Auth Provider is supported by [Socialite](https://socialiteproviders.github.io/).

2) Go to the `SocialAuthentication` Container, API Route file.

3) Add a route for your provider as follow:


```php
<?php

$router->any('auth/twitter', [
    'uses' => 'Controller@authenticateTwitter',
]); 
```

4) Go to `app/Containers/SocialAuthentication/SocialProvider.php` and add your provider name as constant.

5) Go to the Controller and add function to handle the request, inject in it `SocialLoginAction` and pass to it the provider name.


```php
<?php

public function authenticateTwitter(AuthenticateOneRequest $request, SocialLoginAction $action)
{
    $user = $action->run(SocialProvider::TWITTER);

    return $this->response->item($user, new UserTransformer());
}
```
	    
	     
6) Go to the Provider website and create an App to get Key and Secret.

7) Go to `config/services.php` and set your credentials.


```php
<?php

// ...

'facebook' => [ // https://developers.facebook.com/apps
    'client_id'     => env('AUTH_FACEBOOK_CLIENT_ID'), // App ID
    'client_secret' => env('AUTH_FACEBOOK_CLIENT_SECRET'), // App Secret
    'redirect'      => env('AUTH_FACEBOOK_CLIENT_REDIRECT'),
],
	
	    'twitter' => [ // https://apps.twitter.com/app
    'client_id'     => env('AUTH_TWITTER_CLIENT_ID'), // Consumer Key (API Key)
    'client_secret' => env('AUTH_TWITTER_CLIENT_SECRET'), // Consumer Secret (API Secret)
    'redirect'      => env('AUTH_TWITTER_CLIENT_REDIRECT'),
],
	
	    'google' => [ // https://console.developers.google.com/apis/credentials
    'client_id'     => env('AUTH_GOOGLE_CLIENT_ID'), // Client ID
    'client_secret' => env('AUTH_GOOGLE_CLIENT_SECRET'), // Client secret
    'redirect'      => env('AUTH_GOOGLE_CLIENT_REDIRECT'),
],
	 
```



