<?php

namespace App\Ship\Parents\ValueObject;

use Apiato\Core\Abstracts\ValueObjects\ValueObject as AbstractValueObject;
use Apiato\Core\Traits\HasResourceKeyTrait;

/**
 * Class ValueObject.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ValueObject extends AbstractValueObject
{

    use HasResourceKeyTrait;

}
