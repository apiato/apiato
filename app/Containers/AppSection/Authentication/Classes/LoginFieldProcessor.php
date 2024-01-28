<?php

namespace App\Containers\AppSection\Authentication\Classes;

use App\Containers\AppSection\Authentication\Values\IncomingLoginField;
use Illuminate\Support\Arr;

class LoginFieldProcessor
{
    /**
     * Extract all matching login fields from the given data.
     * The login fields are the fields that are allowed to be used as login credentials.
     * The login fields are defined in the config file.
     * The login fields are extracted from the given data.
     * The login fields are returned as an array of IncomingLoginField objects.
     * The login fields are returned in the order they are defined in the config file.
     * TODO: update this docblock.
     *
     * @param array<string, mixed> $data
     *
     * @return IncomingLoginField[]
     */
    public static function extractAll(array $data): array
    {
        $result = static::extractAllMatchingLoginFields($data);

        if ([] === $result) {
            throw new \RuntimeException('No matching login field found');
        }

        return $result;
    }

    /**
     * @return IncomingLoginField[]
     */
    private static function extractAllMatchingLoginFields(array $data): array
    {
        $result = [];
        foreach (static::getAllowedLoginFields() as $fieldName) {
            $fieldValue = static::getMatchingLoginFieldValue($fieldName, $data);

            if (static::loginFieldHasValue($fieldValue)) {
                $result[] = new IncomingLoginField($fieldName, $fieldValue);
            }
        }

        return $result;
    }

    /**
     * @return array<int, string> [key => field]
     */
    private static function getAllowedLoginFields(): array
    {
        $allowedLoginFields = config('appSection-authentication.login.fields');
        if (!$allowedLoginFields) {
            $allowedLoginFields = ['email' => []];
        }

        if (!is_array($allowedLoginFields)) {
            throw new \InvalidArgumentException('Login {fields} property must be an array, ' . gettype($allowedLoginFields) . ' given');
        }

        $fieldNames = array_keys($allowedLoginFields);
        foreach ($fieldNames as $key => $fieldName) {
            if (!is_string($fieldName)) {
                throw new \InvalidArgumentException('Login fields keys must be a string, ' . gettype($fieldName) . ' given');
            }
        }

        return $fieldNames;
    }

    private static function getMatchingLoginFieldValue(string $field, array $from): string|null
    {
        $result = Arr::get($from, static::prepareLoginField($field));
        if (!is_string($result) || empty($result)) {
            return null;
        }

        return $result;
    }

    private static function prepareLoginField(string $field): string
    {
        return static::getPrefix() . $field;
    }

    private static function getPrefix(): string
    {
        return config('appSection-authentication.login.prefix', '');
    }

    private static function loginFieldHasValue(string|null $loginFieldValue): bool
    {
        return null !== $loginFieldValue;
    }

    // TODO: I think this should be moved to a separate class
    public static function mergeValidationRules(array $rules): array
    {
        $allowedLoginFields = config('appSection-authentication.login.fields', ['email' => []]);

        if (!is_array($allowedLoginFields)) {
            throw new \InvalidArgumentException('The login fields must be an array');
        }

        if (1 === count($allowedLoginFields)) {
            $loginField = array_key_first($allowedLoginFields);
            $optionalValidators = $allowedLoginFields[$loginField];
            $validators = implode('|', $optionalValidators);

            $fieldName = static::prepareLoginField($loginField);

            $rules[$fieldName] = "required:{$fieldName}|{$validators}";

            return $rules;
        }

        foreach ($allowedLoginFields as $loginField => $optionalValidators) {
            $otherLoginFields = Arr::except($allowedLoginFields, $loginField);
            $otherLoginFields = array_keys($otherLoginFields);
            $otherLoginFields = preg_filter('/^/', static::getPrefix(), $otherLoginFields);
            $otherLoginFields = implode(',', $otherLoginFields);

            $validators = implode('|', $optionalValidators);

            $fieldName = static::prepareLoginField($loginField);

            $rules[$fieldName] = "required_without_all:{$otherLoginFields}|{$validators}";
        }

        return $rules;
    }
}
