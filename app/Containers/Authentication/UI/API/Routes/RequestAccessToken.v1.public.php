<?php

/**
 * @apiGroup           OAuth2
 * @apiName            RequestAccessTokenCredentials
 * @apiDescription     Use this endpoint to request an access token. You must have client ID and secret first.
 *                     You can generate them by creating new Client in our Web App.
 * @api                {post} /v1/oauth/token Request Access Token (Client)
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  client_id
 * @apiParam           {String}  client_secret
 * @apiParam           {String}  grant_type must be `client_credentials`
 * @apiParam           {String}  [scope] you can leave it empty
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
  "token_type": "Bearer",
  "expires_in": 315360000,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
}
 */

