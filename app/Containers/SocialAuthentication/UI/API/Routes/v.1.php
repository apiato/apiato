<?php

/*********************************************************************************
 * @apiGroup           SocialAuth
 * @apiName            AuthWithTwitter
 * @api                {GET/POST} /auth/twitter
 * @apiDescription     After getting the User Token from twitter, call this Endpoint
 * passing the user token to it in order to fetch his data and create the user in our
 * database if not exist or return the existing one.
 * For testing purposes use this endpoint `auth/twitter/test` to get the code/token.
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiHeader          visitor-id The Device ID [12345] (required in case you are enabling Visitors)
 * @apiParam           oauth_token              ?oauth_token=FeUoXZRIThimLxKjg6HqyzELREJr103L (required)
 * @apiParam           oauth_verifier           ?oauth_verifier=144hi333mLxKjg6HqyzELRE13LxYz (required)
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK

  "data": {
    "id": 1,
    "name": "Mahmoud Zalt",
    "email": "mahmoud@zalt.me",
    "confirmed": 0,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
    "referral_code": "57aa0b88ab334",
    "visitor_id": "123456789",
    "nickname": "MEGA",
    "social_auth_provider": "twitter",
    "social_id": "5713788888",
    "social_avatar": {
        "avatar": "https://graph.twitter.com/v2.6/88208885713788888/picture?type=normal",
        "original": "https://graph.twitter.com/v2.6/88208885713788888/picture?width=1920"
    },
    "created_at": {
      "date": "2016-08-09 16:57:44.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-08-09 16:59:04.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
}
 */
$router->any('auth/twitter', [
    'uses' => 'Controller@authenticateTwitter',
]);

/*********************************************************************************
 * @apiGroup           SocialAuth
 * @apiName            AuthWithFacebook
 * @api                {get} /auth/facebook
 * @apiDescription     After getting the User Token from facebook, call this Endpoint
 * passing the user token to it in order to fetch his data and create the user in our
 * database if not exist or return the existing one.
 * For testing purposes use this endpoint `auth/facebook/test` to get the code/token.
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiParam           code            code=41JfK_Pu1VXAkcJTe3Bca3v87MY (required)
 * @apiParam           state           state=rZPGzQ850a5f4OxlKexzTL29Vi (required)
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK

  "data": {
    "id": 1,
    "name": "Mahmoud Zalt",
    "email": "mahmoud@zalt.me",
    "confirmed": 0,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
    "referral_code": "57aa0b88ab334",
    "visitor_id": "123456789",
    "nickname": "MEGA",
    "social_auth_provider": "facebook",
    "social_id": "88208885713788888",
    "social_avatar": {
        "avatar": "https://graph.facebook.com/v2.6/88208885713788888/picture?type=normal",
        "original": "https://graph.facebook.com/v2.6/88208885713788888/picture?width=1920"
    },
    "created_at": {
      "date": "2016-08-09 16:57:44.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-08-09 16:59:04.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
}
 */
$router->any('auth/facebook', [
    'uses' => 'Controller@authenticateFacebook',
]);

/*********************************************************************************
 * @apiGroup           SocialAuth
 * @apiName            AuthWithGoogle
 * @api                {get} /auth/google
 * @apiDescription     After getting the User Token from google, call this Endpoint
 * passing the user token to it in order to fetch his data and create the user in our
 * database if not exist or return the existing one.
 * For testing purposes use this endpoint `auth/google/test` to get the code/token.
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiHeader          Accept application/json (required)
 * @apiParam           code            code=41JfK_Pu1VXAkcJTe3Bca3v87MY (required)
 * @apiParam           state           state=rZPGzQ850a5f4OxlKexzTL29Vi (required)
 * @apiParam           authuser        authuser=0&session_state=9045a1 (required)
 * @apiParam           prompt          prompt=none#
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK

  "data": {
    "id": 1,
    "name": "Mahmoud Zalt",
    "email": "mahmoud@zalt.me",
    "confirmed": 0,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
    "referral_code": "57aa0b88ab334",
    "visitor_id": "123456789",
    "nickname": "MEGA",
    "social_auth_provider": "google",
    "social_id": "11111208885713788888",
    "social_avatar": {
        "avatar": "https://graph.google.com/v2.6/88208885713788888/picture?type=normal",
        "original": "https://graph.google.com/v2.6/88208885713788888/picture?width=1920"
    },
    "created_at": {
      "date": "2016-08-09 16:57:44.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2016-08-09 16:59:04.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    }
  }
}
 */
$router->any('auth/google', [
    'uses' => 'Controller@authenticateGoogle',
]);



// FOR LIVE TESTING ONLY

$router->any('auth/google/test', [
    'uses'       => function () {
        return Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    },
]);

$router->any('auth/twitter/test', [
    'uses'       => function () {
        return Laravel\Socialite\Facades\Socialite::driver('twitter')->redirect();
    },
]);

$router->any('auth/facebook/test', [
    'uses'       => function () {
        return Laravel\Socialite\Facades\Socialite::driver('facebook')->redirect();
    },
]);
