<?php

namespace App\Ship\Parents\Values;

use Apiato\Abstract\Values\Value as AbstractValue;
use Illuminate\Contracts\Support\Arrayable;

abstract readonly class Value extends AbstractValue implements Arrayable
{
    abstract public function toArray(): array;
}
