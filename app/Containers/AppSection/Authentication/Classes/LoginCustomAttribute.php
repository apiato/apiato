<?php

namespace App\Containers\AppSection\Authentication\Classes;

use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Arr;

class LoginCustomAttribute
{
    /**
     * Extract the login custom attributes.
     *
     * @param array<string, mixed> $data
     *
     * @return string[] [loginFieldValue, loginFieldName]
     *
     * @throws NotFoundException
     */
    public static function extract(array $data): array
    {
        [$loginFieldName, $loginFieldValue] = static::getLoginFields($data);

        if (!is_string($loginFieldName) || !is_string($loginFieldValue) || static::noMatchingLoginFieldFound($loginFieldValue)) {
            throw new NotFoundException('No matching login field found');
        }

        return [
            static::processLoginAttributeCaseSensitivity($loginFieldValue),
            $loginFieldName,
        ];
    }

    /**
     * @return array<array-key, mixed|null> [loginFieldName, loginFieldValue]
     */
    private static function getLoginFields(array $data): array
    {
        $loginFieldName = null;
        $loginFieldValue = null;
        foreach (static::getAllowedLoginAttributes() as $allowedLoginAttribute) {
            $loginFieldValue = static::getMatchingLoginFieldValue($allowedLoginAttribute, $data);

            // Exit the loop on the first matching login attribute found
            if (static::loginFieldHasValue($loginFieldValue)) {
                $loginFieldName = $allowedLoginAttribute;
                break;
            }
        }

        return [$loginFieldName, $loginFieldValue];
    }

    /**
     * @return array<int, string> [key => attributeName]
     */
    private static function getAllowedLoginAttributes(): array
    {
        $allowedLoginAttributes = config('appSection-authentication.login.attributes');
        if (!$allowedLoginAttributes) {
            $allowedLoginAttributes = ['email' => []];
        }

        if (!is_array($allowedLoginAttributes)) {
            throw new \InvalidArgumentException('The login attributes must be an array');
        }

        $attributeNames = array_keys($allowedLoginAttributes);
        foreach ($attributeNames as $key => $attributeName) {
            if (!is_string($attributeName)) {
                throw new \InvalidArgumentException('The login attribute must be a string');
            }
        }

        return $attributeNames;
    }

    private static function getMatchingLoginFieldValue(string $attribute, array $from): string|null
    {
        $result = Arr::get($from, static::prepareLoginAttribute($attribute));
        if (!is_string($result) || empty($result)) {
            return null;
        }

        return $result;
    }

    private static function prepareLoginAttribute(string $attribute): string
    {
        return static::getPrefix() . $attribute;
    }

    private static function loginFieldHasValue(mixed $loginFieldValue): bool
    {
        return null !== $loginFieldValue;
    }

    private static function noMatchingLoginFieldFound(mixed $loginFieldValue): bool
    {
        return empty($loginFieldValue);
    }

    private static function processLoginAttributeCaseSensitivity(string $username): string
    {
        if (config('appSection-authentication.login.case_sensitive')) {
            return $username;
        }

        return strtolower($username);
    }

    public static function mergeValidationRules(array $rules): array
    {
        $allowedLoginAttributes = config('appSection-authentication.login.attributes', ['email' => []]);

        if (!is_array($allowedLoginAttributes)) {
            throw new \InvalidArgumentException('The login attributes must be an array');
        }

        if (1 === count($allowedLoginAttributes)) {
            $loginAttribute = array_key_first($allowedLoginAttributes);
            $optionalValidators = $allowedLoginAttributes[$loginAttribute];
            $validators = implode('|', $optionalValidators);

            $fieldName = static::prepareLoginAttribute($loginAttribute);

            $rules[$fieldName] = "required:$fieldName|$validators";

            return $rules;
        }

        foreach ($allowedLoginAttributes as $loginAttribute => $optionalValidators) {
            $otherLoginFields = Arr::except($allowedLoginAttributes, $loginAttribute);
            $otherLoginFields = array_keys($otherLoginFields);
            $otherLoginFields = preg_filter('/^/', static::getPrefix(), $otherLoginFields);
            $otherLoginFields = implode(',', $otherLoginFields);

            $validators = implode('|', $optionalValidators);

            $fieldName = static::prepareLoginAttribute($loginAttribute);

            $rules[$fieldName] = "required_without_all:$otherLoginFields|$validators";
        }

        return $rules;
    }

    private static function getPrefix(): string
    {
        return config('appSection-authentication.login.prefix', '');
    }
}
