<?php

namespace App\Ship\Controller\Abstracts;

use App\Ship\Controller\Contracts\ApiControllerInterface;
use Dingo\Api\Routing\Helpers as DingoApiHelper;

/**
 * Class ShipApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ShipApiController extends ShipController implements ApiControllerInterface
{

    use DingoApiHelper;
}
