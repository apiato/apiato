<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;

class IncomingLoginField extends ParentValue
{
    public function __construct(
        public readonly string $name,
        public readonly string $value,
    ) {
    }
}
