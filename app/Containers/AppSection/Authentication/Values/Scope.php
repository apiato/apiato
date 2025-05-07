<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;

final readonly class Scope extends ParentValue
{
    private function __construct(
        private string $name,
    ) {
    }

    public static function create(string $name): self
    {
        return new self($name);
    }

    public function value(): string
    {
        return $this->name;
    }
}
