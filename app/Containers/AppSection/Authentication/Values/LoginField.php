<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;

final class LoginField extends ParentValue implements \Stringable
{
    public function __construct(
        private readonly string $name,
        private readonly array $rules,
    ) {
    }

    public function toArray(): array
    {
        return [$this->name => $this->rules];
    }

    public function rules(): array
    {
        return $this->rules;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
