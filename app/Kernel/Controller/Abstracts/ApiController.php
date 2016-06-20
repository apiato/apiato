<?php

namespace App\Kernel\Controller\Abstracts;

use Dingo\Api\Routing\Helpers as DingoApiHelper;
use App\Kernel\Controller\Contracts\ApiControllerInterface;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends KernelController implements ApiControllerInterface
{

    use DingoApiHelper;
}
