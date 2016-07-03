<?php

namespace App\Kernel\Controller\Abstracts;

use App\Kernel\Controller\Contracts\ApiControllerInterface;
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
