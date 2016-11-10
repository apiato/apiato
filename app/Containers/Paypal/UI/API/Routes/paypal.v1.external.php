<?php


/*********************************************************************************
 * @apiGroup           Paypal
 * @apiName            createPaypalAccount
 * @api                {post} /paypals Save Paypal Information
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json
 * @apiParam           customer_id
 * @apiParam           some_id   // TODO: To Be Continue...
 */

$router->post('/paypals', [
    'uses' => 'Controller@createPaypalAccount',
]);
