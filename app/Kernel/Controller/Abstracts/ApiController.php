<?php

namespace App\Kernel\Controller\Abstracts;

use App\Kernel\Controller\Contracts\ApiControllerInterface;
use Dingo\Api\Routing\Helpers as DingoApiHelper;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends KernelController implements ApiControllerInterface
{

    use DingoApiHelper;
}
