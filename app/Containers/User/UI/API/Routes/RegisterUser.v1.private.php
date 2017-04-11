<?php

/**
 * @apiGroup           Users
 * @apiName            registerUser
 * @api                {post} /v1/register Register User (create client)
 * @apiDescription     Register new user as client.
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email (required)
 * @apiParam           {String}  password (required)
 * @apiParam           {String}  name (optional)
 * @apiParam           {String}  gender (optional)
 * @apiParam           {String}  birth (optional)
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
  "data": {
    "object": "User",
    "id": 3,
    "name": "Mahmoud Zalt",
    "email": "apiato@mail.com",
    "confirmed": null,
    "nickname": "Mega",
    "gender": "male",
    "birth": null,
    "social_auth_provider": null,
    "social_id": null,
    "social_avatar": {
      "avatar": null,
      "original": null
    },
    "created_at": {
      "date": "2017-04-05 16:17:26.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "updated_at": {
      "date": "2017-04-05 16:17:26.000000",
      "timezone_type": 3,
      "timezone": "UTC"
    },
    "roles": {
      "data": []
    }
  }
}
 */

$router->post('/register', [
    'uses'  => 'Controller@registerUser',
]);
