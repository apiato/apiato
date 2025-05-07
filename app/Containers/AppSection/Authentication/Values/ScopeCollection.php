<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;

final readonly class ScopeCollection extends ParentValue
{
    private function __construct(
        /** @var Scope[] */
        private array $scope,
    ) {
    }

    public static function create(Scope ...$scope): self
    {
        return new self($scope);
    }

    public static function from(string $scope): self
    {
        return new self(array_map(static fn (string $scope): Scope => Scope::create($scope), explode(' ', $scope)));
    }

    public function toString(): string
    {
        return implode(' ', array_map(static fn (Scope $scope): string => $scope->value(), $this->scope));
    }
}
