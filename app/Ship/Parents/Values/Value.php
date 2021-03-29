<?php

namespace App\Ship\Parents\Values;

use Apiato\Core\Abstracts\Values\Value as AbstractValue;
use Apiato\Core\Traits\HasResourceKeyTrait;

abstract class Value extends AbstractValue
{
    use HasResourceKeyTrait;
}
