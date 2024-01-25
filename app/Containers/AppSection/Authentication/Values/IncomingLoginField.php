<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;

class IncomingLoginField extends ParentValue implements \Stringable
{
    public function __construct(
        public readonly string $field,
        public readonly string $value,
    ) {
    }

    public function __toString(): string
    {
        return $this->field;
    }

    final public function toArray(): array
    {
        return [$this->field => $this->value];
    }
}
