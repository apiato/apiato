<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\Model as AbstractModel;
use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;

/**
 * Class Model.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Model extends AbstractModel
{

    use HashIdTrait;
    use HasResourceKeyTrait;

}
