<?php

namespace Mega\Services\Core\Controller\Abstracts;

use Dingo\Api\Routing\Helpers as DingoApiHelper;
use Mega\Services\Core\Controller\Contracts\ApiControllerInterface;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends MasterController implements ApiControllerInterface
{

    use DingoApiHelper;
}
