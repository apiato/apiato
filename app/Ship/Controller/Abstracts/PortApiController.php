<?php

namespace App\Ship\Controller\Abstracts;

use App\Ship\Controller\Contracts\ApiControllerInterface;
use Dingo\Api\Routing\Helpers as DingoApiHelper;

/**
 * Class PortApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class PortApiController extends PortController implements ApiControllerInterface
{

    use DingoApiHelper;
}
