<?php

/*
 * @apiGroup           OAuth2
 * @apiName            LoginPasswordGrant
 * @api                {post} /v1/oauth/token Login (Password Grant)
 * @apiDescription     Login Users using their username and passwords. (For First-Party Clients)
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiHeader          {String} accept=application/json
 *
 * @apiBody           {String}  username user email
 * @apiBody           {String}  password user password
 * @apiBody           {String}  client_id
 * @apiBody           {String}  client_secret
 * @apiBody           {String="password"}  grant_type
 * @apiBody           {String}  [scope]
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "token_type": "Bearer",
 * "expires_in": 315360000,
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
 * "refresh_token": "Oukd61zgKzt8TBwRjnasd..."
 * }
 */

// Implementation in the Laravel Passport package and overridden in Passport.v1.private.php
