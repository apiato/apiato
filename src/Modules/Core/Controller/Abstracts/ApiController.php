<?php

namespace Hello\Modules\Core\Controller\Abstracts;

use Dingo\Api\Routing\Helpers as DingoApiHelper;
use Hello\Modules\Core\Controller\Contracts\ApiControllerInterface;

/**
 * Class ApiController.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiController extends CoreController implements ApiControllerInterface
{

    use DingoApiHelper;
}
