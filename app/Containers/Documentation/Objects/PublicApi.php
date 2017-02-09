<?php

namespace App\Containers\Documentation\Objects;

use App\Containers\Documentation\Abstracts\ApiTypeAbstract;
use App\Containers\Documentation\Contracts\ApiTypeInterface;

/**
 * Class PublicApi.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PublicApi extends ApiTypeAbstract implements ApiTypeInterface
{

    public static $type = 'public';

}
