<?php

/*
 * @apiGroup           OAuth2
 * @apiName            LoginCredentialsGrant
 * @api                {post} /v1/oauth/token Login (Client Credentials Grant)
 * @apiDescription     Login Users using their username and passwords. (For Third-Party Clients).
 *                     You must have client ID and secret first. You can generate them by creating new Client in our Web App.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody           {String}  client_id
 * @apiBody           {String}  client_secret
 * @apiBody           {String="client_credentials"}  grant_type
 * @apiBody           {String}  [scope]
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "token_type": "Bearer",
 * "expires_in": 315360000,
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
 * }
 */

// Implementation in the Laravel Passport package and overridden in Passport.v1.private.php
