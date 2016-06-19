<?php

namespace App\Engine\Controller\Abstracts;

use Dingo\Api\Routing\Helpers as DingoApiHelper;
use App\Engine\Controller\Contracts\ApiControllerInterface;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends CoreController implements ApiControllerInterface
{

    use DingoApiHelper;
}
