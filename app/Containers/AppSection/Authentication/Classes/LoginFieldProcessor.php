<?php

namespace App\Containers\AppSection\Authentication\Classes;

use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Arr;

class LoginFieldProcessor
{
    /**
     * Extract the login fields.
     *
     * @param array<string, mixed> $data
     *
     * @return string[] [loginFieldValue, loginFieldName]
     *
     * @throws NotFoundException
     */
    public static function extract(array $data): array
    {
        [$loginFieldName, $loginFieldValue] = static::getFirstMatchingLoginField($data);

        if (!is_string($loginFieldName) || !is_string($loginFieldValue) || static::noMatchingLoginFieldFound($loginFieldValue)) {
            throw new NotFoundException('No matching login field found');
        }

        return [
            $loginFieldValue,
            $loginFieldName,
        ];
    }

    /**
     * @return array<array-key, mixed|null> [loginFieldName, loginFieldValue]
     */
    private static function getFirstMatchingLoginField(array $data): array
    {
        $loginFieldName = null;
        $loginFieldValue = null;
        foreach (static::getAllowedLoginFields() as $allowedLoginField) {
            $loginFieldValue = static::getMatchingLoginFieldValue($allowedLoginField, $data);

            if (static::loginFieldHasValue($loginFieldValue)) {
                $loginFieldName = $allowedLoginField;
                break;
            }
        }

        return [$loginFieldName, $loginFieldValue];
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
            throw new \InvalidArgumentException("Login {fields} property must be an array, " . gettype($allowedLoginFields) . " given");
        }

        $fieldNames = array_keys($allowedLoginFields);
        foreach ($fieldNames as $key => $fieldName) {
            if (!is_string($fieldName)) {
                throw new \InvalidArgumentException("Login fields keys must be a string, " . gettype($fieldName) . " given");
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

    private static function loginFieldHasValue(string|null $loginFieldValue): bool
    {
        return null !== $loginFieldValue;
    }

    private static function noMatchingLoginFieldFound(string $loginFieldValue): bool
    {
        return empty($loginFieldValue);
    }

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

    private static function getPrefix(): string
    {
        return config('appSection-authentication.login.prefix', '');
    }
}
