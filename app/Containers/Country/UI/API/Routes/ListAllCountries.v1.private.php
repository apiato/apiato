<?php

/*********************************************************************************
 * @apiGroup           Countries
 * @apiName            listAllCountries
 * @api                {get} /countries List all Countries
 * @apiDescription     List all Countries, non paginated
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User|Authorized App
 *
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 200 OK
{
   "data":[
      {
         "type":"country",
         "id":4,
         "name":"Afghanistan",
         "full_name":"Islamic Republic of Afghanistan",
         "iso_3166_2":"AF",
         "country_flag":"http:\/\/api.apiato.dev\/assets\/flags\/AF.png"
      },
      {
         "type":"country",
         "id":8,
         "name":"Albania",
         "full_name":"Republic of Albania",
         "iso_3166_2":"AL",
         "country_flag":"http:\/\/api.apiato.dev\/assets\/flags\/AL.png"
      },
      {
         "type":"country",
         "id":12,
         "name":"Algeria",
         "full_name":"People\u2019s Democratic Republic of Algeria",
         "iso_3166_2":"DZ",
         "country_flag":"http:\/\/api.apiato.dev\/assets\/flags\/DZ.png"
      }
      ...
   ]
}
 */

$router->get('countries', [
    'uses'       => 'Controller@listAllCountries',
    'middleware' => [
        'api.auth',
    ],
]);
