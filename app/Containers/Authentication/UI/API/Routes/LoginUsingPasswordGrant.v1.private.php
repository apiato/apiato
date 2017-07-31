<?php

/**
 * @apiGroup           OAuth2
 * @apiName            LoginPasswordGrant
 * @api                {post} /v1/oauth/token Login (Password Grant)
 * @apiDescription     Login Users using their username and passwords. (For First-Party Clients)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  username user email
 * @apiParam           {String}  password user password
 * @apiParam           {String}  client_id
 * @apiParam           {String}  client_secret
 * @apiParam           {String}  grant_type must be `password`
 * @apiParam           {String}  [scope] you can leave it empty
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
  "token_type": "Bearer",
  "expires_in": 315360000,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
  "refresh_token": "Oukd61zgKzt8TBwRjnasd..."
}
 */

// Implementation in the Laravel Passport package
