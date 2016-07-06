<?php

namespace App\Ship\Controller\Abstracts;

use App\Ship\Controller\Contracts\ApiControllerInterface;
use Dingo\Api\Routing\Helpers as DingoApiHelper;

/**
 * Class KernelApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class KernelApiController extends KernelController implements ApiControllerInterface
{

    use DingoApiHelper;
}
