<?php

namespace App\Port\Controller\Abstracts;

use App\Port\Controller\Contracts\ApiControllerInterface;
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
