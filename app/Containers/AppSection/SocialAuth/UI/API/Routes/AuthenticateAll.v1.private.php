<?php

/**
 * @apiGroup           SocialAuth
 *
 * @apiName            socialAuthAll
 *
 * @api                {post} /v1/auth/{provider} Auth for all Providers
 *
 * @apiDescription     After getting the User Access Token from the provider (e.g. Google), call this Endpoint like this
 * `/v1/auth/google` passing the access token to it in order to fetch his data and create the user in our
 * database if not exist or return the existing one.
 *
 * @apiVersion         1.0.0
 *
 * @apiPermission      none
 *
 * @apiParam           oauth_token  token provided by the social provider
 * @apiParam           [oauth_secret] some providers like Twitter provide this
 *
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 200 OK
 * {
 * // here we will return a User transformer response + some custom meta data
 * // you can set the transformer in vendor-socialAuth config (you have to publish it first -> vendor:publish)
 * .
 * .
 * .
 * "meta": {
 * "include": [
 * "roles"
 * ],
 * "custom": {
 * "token_type": "personal",
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiODE0MTQ5NGQ4YzM2OTJlYjJkZWU2MDcyYjk2NzIyYzczMmQyNmIyNWY0ZGZkZjg3Y2ZjOWRmOWVhYmE3YzU1OTdkNGFlMDRiMTg3MGM0YzUiLCJpYXQiOjE2MzIwNjQ5MzYuNzI1NzM1LCJuYmYiOjE2MzIwNjQ5MzYuNzI1NzQxLCJleHAiOjE2NjM2MDA5MzYuNzE3MDQ2LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.D2KM50poeJ2SmelwpJvYr2tyDoDH-jFx-ZF1yh-ehkrzu_ZjUc-wZg-WLtGMf1LlE_Eng_cmAHFgqSpXYIyO0lQuRCB-3AdYCcyhLs1QYaL60LiUIshq8P_fx9crXt4d2NdPs0SYwSKFHd88YZWzcPVNXDukCM8VdVQvUtMUxnS5ZjffM0asPf6vYebnMeixbjsp2ljoxLRsaorqTVE8nMdiXx51Pv3BXM3J8fgxnuNDfHxRKEiYc3kjy1k0dUZAeJsEBC27FJhzkVXVULkWI3ftq0xKF_039XAgQ8DGTtAEWhoGhQY2K8fGZgfZpLpCUT5qwj_xsakHDx1Y57oIrHTdASgjdKg3mCcXvlQSxXD12un3XNVJeVCPBGRzym4PcbwptfymGN8_CoYPYWpEmkYzC22vwkPKcJsVfSEyMVKjObW4bz7etTAVUXQInwhzDFIYdtuQr49igngz1oer7v6OSGSWZkmBYGP0rQL_hCcXBEwfFnCcoA15GWzx8DSoKQ9vrdbEK2iHzf0iGBSj1BMsjBG6RPZwLfJF7VauFeF-OCAAzJjtUgtQHxZc_ZOIu6fj_Hh2BaVuC4V4QYft37v-9HKHYYoTAZ0Bo0eboFszeLpOXNQz5IjD5X4c7gavBI4FYbyqzQ46g5S_zkMKHbGw5BEaUqiAxMQc5saoXhQ"
 * }
 * }
 * }
 */

use App\Containers\AppSection\SocialAuth\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('auth/{provider}', [Controller::class, 'authenticateAll'])
    ->name('api_socialAuth_social_auth');
