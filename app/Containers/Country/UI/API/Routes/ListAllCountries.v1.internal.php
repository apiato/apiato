<?php

/*********************************************************************************
 * @apiGroup           Countries
 * @apiName            listAllCountries
 * @api                {get} /countries List all Countries
 * @apiDescription     List all Countries, non paginated
 * @apiVersion         1.0.0
 * @apiPermission      none
 * @apiSuccessExample  {json}    Success-Response:
HTTP/1.1 200 OK
{
  "data": [
    {
      "id": 4,
      "name": "Afghanistan",
      "full_name": "Islamic Republic of Afghanistan",
      "iso_3166_2": "AF",
      "currency_code": "AFN",
      "currency_symbol": "http://api.rewardfox.dev/assets/flags/AF.png"
    },
    {
      "id": 248,
      "name": "Åland Islands",
      "full_name": "Åland Islands",
      "iso_3166_2": "AX",
      "currency_code": "EUR",
      "currency_symbol": "http://api.rewardfox.dev/assets/flags"
    },
    {
      "id": 8,
      "name": "Albania",
      "full_name": "Republic of Albania",
      "iso_3166_2": "AL",
      "currency_code": "ALL",
      "currency_symbol": "http://api.rewardfox.dev/assets/flags/AL.png"
    },
    ...
}
 */
$router->get('countries', [
    'uses'       => 'Controller@listAllCountries',
]);
