<?php

namespace App\Containers\Documentation\Objects;

use App\Containers\Documentation\Abstracts\ApiTypeAbstract;
use App\Containers\Documentation\Contracts\ApiTypeInterface;

/**
 * Class PrivateApi.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PrivateApi extends ApiTypeAbstract implements ApiTypeInterface
{

    public static $type = 'private';

}
