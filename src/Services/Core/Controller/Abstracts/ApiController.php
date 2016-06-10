<?php

namespace Hello\Services\Core\Controller\Abstracts;

use Dingo\Api\Routing\Helpers as DingoApiHelper;
use Hello\Services\Core\Controller\Contracts\ApiControllerInterface;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends MasterController implements ApiControllerInterface
{

    use DingoApiHelper;
}
