<?php

/**
 * @apiGroup           SocialAuth
 * @apiName            socialAuthTw
 * @api                {post} /v1/auth/twitter
 * @apiDescription     After getting the User Token from twitter, call this Endpoint
 * passing the user token to it in order to fetch his data and create the user in our
 * database if not exist or return the existing one.
 * For testing purposes use this endpoint `auth/twitter/` to get the token.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           oauth_token
 * @apiParam           oauth_secret
 *
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 200 OK
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
 */

/**
 * @apiGroup           SocialAuth
 * @apiName            socialAuthFb
 * @api                {post} /v1/auth/facebook
 * @apiDescription     After getting the User Token from facebook, call this Endpoint
 * passing the user token to it in order to fetch his data and create the user in our
 * database if not exist or return the existing one.
 * For testing purposes use this endpoint `auth/facebook` to get the token.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           oauth_token
 *
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK
{
    "data": {
        "object": "User",
        "id": "eqwja3vw94kzmxr1",
        "name": "Mahmoud Zalt",
        "email": null,
        "confirmed": false,
        "nickname": null,
        "gender": null,
        "birth": null,
        "social_auth_provider": "facebook",
        "social_id": "42719726",
        "social_avatar": {
            "avatar": null,
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
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUxI..."
        }
    }
}
 */
$router->post('auth/{provider}', [
    'as' => 'api_socialauth_social_auth',
    'uses' => 'Controller@authenticateAll',
]);
