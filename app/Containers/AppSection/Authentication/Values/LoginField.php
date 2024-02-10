<?php

namespace App\Containers\AppSection\Authentication\Values;

use App\Ship\Parents\Values\Value as ParentValue;
use Illuminate\Validation\Validator;

final class LoginField extends ParentValue implements \Stringable
{
    private readonly Validator $validator;

    public function __construct(
        private string $name,
        private array $rules,
    ) {
        $this->validator = validator([], $this->rules);
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
        return $this->validator->getRules();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function isRequired(): bool
    {
        return $this->validator->hasRule($this->name, 'required');
    }

    public function makeRequired(): void
    {
        $this->validator->addRules([$this->name => 'required']);
    }

    public function makeRequiredWithoutAll(array $fields): void
    {
        $this->removeRule('required');
        $implodedFields = implode(',', $fields);
        $this->validator->addRules([$this->name, "required_without_all:{$implodedFields}"]);
    }

    public function removeRule(string $ruleToRemove): void
    {
        // Get the current rules
        $rules = $this->validator->getRules();

        // Find the index of the rule to remove
        foreach ($rules as $rule) {
            dump($rule);
            foreach ($rule as $value) {
                dump($value);
            }
        }

        // If the rule is found, remove it
//        if (false !== $index) {
//            unset($fieldRules[$index]);
//        }

        // Set the modified rules back to the field
//        $rules[$this->name] = $fieldRules;

        // Set the modified rules back to the validator
        $this->validator->setRules($rules);
    }

    private function trimPipes(): self
    {
        $instance = clone $this;

        $instance->rules = [trim(str_replace('||', '|', $instance->rules), '|')];

        return $instance;
    }
}
