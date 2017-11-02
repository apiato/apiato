---
title: "Social Authentication"
category: "Features"
order: 6
---

- [Default Supported Auth Provide](#default-supported-auth-provide)
- [How Social Authentication Works](#how-social-authentication-works)
- [Setup Social Authentication](#Setup-Social-Authentication)
- [Support new Auth Provide](#support-new-auth-provide)

<br>
<br>

For Social Authentication Apiato uses [Socialite]( https://github.com/laravel/socialite).




<a name="default-supported-auth-provide"></a>
## Default Supported Auth Provide

* Facebook
* Twitter




<a name="how-social-authentication-works"></a>
## How Social Authentication Works

1. The Client (Mobile or Web) sends a request to the Social Auth Provider (Facebook, Twitter..).
2. The Social Auth Provider returns a Code (Tokens).
3. The Client makes a call to the server (our server) and passes the Code (Tokens) retrieved from the Provider.
4. The Server fetches the user data from the Social Auth Provider using the received Code (Tokens).
5. The Server create new User from the collected social data and return the Authenticated User (If the user already created then it just returns it).



<a name="Setup-Social-Authentication"></a>
## Setup Social Authentication

1) Create an App on the supported Social Auth provider.

- For Facebook: [https://developers.facebook.com/apps](https://developers.facebook.com/apps)
- For Twitter: [https://apps.twitter.com/app](https://apps.twitter.com/app)
- For Google: [https://console.developers.google.com/apis/credentials](https://console.developers.google.com/apis/credentials)

For the callback URL you can use this Apiato web endpoint `http://apiato.dev/auth/{provider}/callback` *(replace the provider with any of the supported providers `facebook`, `twitter`,..)*.

2) Set the Tokens and Secrets in the `.env` file

```php
    'facebook' => [
        'client_id'     => env('AUTH_FACEBOOK_CLIENT_ID'), // App ID
        'client_secret' => env('AUTH_FACEBOOK_CLIENT_SECRET'), // App Secret
        'redirect'      => env('AUTH_FACEBOOK_CLIENT_REDIRECT'),
    ],
    
    'twitter' => [
        'client_id'     => env('AUTH_TWITTER_CLIENT_ID'), // Consumer Key (API Key)
        'client_secret' => env('AUTH_TWITTER_CLIENT_SECRET'), // Consumer Secret (API Secret)
        'redirect'      => env('AUTH_TWITTER_CLIENT_REDIRECT'),
    ],
    
    'google' => [
        'client_id'     => env('AUTH_GOOGLE_CLIENT_ID'), // Client ID
        'client_secret' => env('AUTH_GOOGLE_CLIENT_SECRET'), // Client secret
        'redirect'      => env('AUTH_GOOGLE_CLIENT_REDIRECT'),
    ],
```

3) Make a request from your client to get the `oauth` info. **Each Social provider returns different response and keys**

For testing purposes Apiato provides a web endpoint (`http://apiato.dev/auth/{provider}` ) to act as a client.

Use that endpoint from your browser *(replace the provider with any of the supported providers `facebook`, `twitter`,..)* to get the `oauth` info. 

Example Twitter Response:

```text
User {
  tokentoken: "121212121-121212121"
  tokentokenSecret: "34343434343434343343434343"
  tokenid: "777777777"
  tokennickname: "Mahmoud_Zalt"
  tokenname: "Mahmoud Zalt"
  tokenemail: null
  tokenavatar: "http://pbs.twimg.com/profile_images/88888888/PENrcePC_normal.jpg"
  tokenuser:
  token"avatar_original": "http://pbs.twimg.com/profile_images/9999999/PENrcePC.jpg"
}
```

NOTE: This step should be done by your client App, which could be a Web, Mobile or other kind of client Apps.

4) Use the `oauth` info to make a call from your server to the Social Provider in order to get the User info.

Example Getting Twitter User: **Twitter requires the `oauth_token` and `oauth_secret`, other Providers might only require the `oauth_token`**

```text
POST /v1/auth/twitter HTTP/1.1
Host: api.apiato.dev
Content-Type: application/x-www-form-urlencoded
Accept: application/json

oauth_token=121212121-121212121&oauth_secret=34343434343434343343434343
```

Note: For Facebook send only the `oauth_token` which is named as `access_token` in the facebook response. 
For more details about the parameters checkout the generated documentation or visit `app/Containers/Socialauth/UI/API/Routes/AuthenticateAll.v1.private.php`  

5) The endpoint above should return the User and his Personal Access Token.

Example Twitter Response:  

```json
{
    "data": {
        "object": "User",
        "id": "eqwja3vw94kzmxr0",
        "name": "Mahmoud Zalt",
        "email": null,
        "confirmed": false,
        "nickname": null,
        "gender": null,
        "birth": null,
        "social_auth_provider": "twitter",
        "social_id": "42719726",
        "social_avatar": {
            "avatar": "http://pbs.twimg.com/profile_images/1111111111/PENrcePC_normal.jpg",
            "original": null
        },
        "created_at": {
            "date": "2017-10-20 21:45:03.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "updated_at": {
            "date": "2017-10-20 21:45:03.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "readable_created_at": "48 minutes ago",
        "readable_updated_at": "48 minutes ago"
    },
    "meta": {
        "include": [
            "roles"
        ],
        "custom": {
            "token_type": "personal",
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI..."
        }
    }
}
```


<a name="support-new-auth-provide"></a>
## Support new Auth Provider

1) Pick an Auth Provider from the supported providers by [Socialite](https://socialiteproviders.github.io/).

2) Go to `app/Containers/Socialauth/Tasks/FindUserSocialProfileTask.php` and support your provider. 
