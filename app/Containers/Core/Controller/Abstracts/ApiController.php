<?php

namespace App\Containers\Core\Controller\Abstracts;

use Dingo\Api\Routing\Helpers as DingoApiHelper;
use App\Containers\Core\Controller\Contracts\ApiControllerInterface;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends CoreController implements ApiControllerInterface
{

    use DingoApiHelper;
}
