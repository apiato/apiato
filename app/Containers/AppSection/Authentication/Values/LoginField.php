<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;
use Illuminate\Validation\ValidationRuleParser;

final class LoginField extends ParentValue implements \Stringable
{
    public function __construct(
        private string $name,
        private array $rules,
    ) {
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [$this->name => $this->rules];
    }

    public function rules(): array
    {
        return [$this->uniqueRules()];
    }

    public function name(): string
    {
        return $this->name;
    }

    private function uniqueRules(): string
    {
        ValidationRuleParser::parse($this->rules);

        return implode('|', array_unique(explode('|', implode('|', $this->rules))));
    }

    private function isRequired(): bool
    {
        return !str_contains($this->uniqueRules(), 'required');
    }

    public function makeRequired(bool $required = true): self
    {
        if ($required && $this->isRequired()) {
            $this->rules[] = 'required';
        }

        return $this;
    }

    private function trimPipes(): self
    {
        $instance = clone $this;

        $instance->rules = [trim(str_replace('||', '|', $instance->rules), '|')];

        return $instance;
    }
}
