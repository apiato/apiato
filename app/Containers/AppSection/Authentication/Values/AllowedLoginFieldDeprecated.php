<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;

class AllowedLoginFieldDeprecated extends ParentValue implements \Stringable
{
    public function __construct(
        public readonly string $name,
        public readonly array $rules,
    ) {
    }

    public function __toString(): string
    {
        return $this->name;
    }

    final public function toArray(): array
    {
        return [$this->name => $this->rules];
    }
}
