<?php

use Illuminate\Support\Arr;

if (!function_exists('loginAttributeValidationRulesMerger')) {
    function loginAttributeValidationRulesMerger(array $rules): array
    {
        $prefix = config('authentication-container.login.prefix', '');
        $allowedLoginAttributes = config('authentication-container.login.attributes', ['email' => []]);

        if (count($allowedLoginAttributes) === 1) {
            $key = array_key_first($allowedLoginAttributes);
            $optionalValidators = $allowedLoginAttributes[$key];
            $validators = implode('|', $optionalValidators);

            $fieldName = $prefix . $key;

            $rules[$fieldName] = "required:{$fieldName}|exists:users,{$key}|{$validators}";

            return $rules;
        }

        foreach ($allowedLoginAttributes as $key => $optionalValidators) {
            // build all other login fields together
            $otherLoginFields = Arr::except($allowedLoginAttributes, $key);
            $otherLoginFields = array_keys($otherLoginFields);
            $otherLoginFields = preg_filter('/^/', $prefix, $otherLoginFields);
            $otherLoginFields = implode(',', $otherLoginFields);

            $validators = implode('|', $optionalValidators);

            $fieldName = $prefix . $key;

            $rules[$fieldName] = "required_without_all:{$otherLoginFields}|exists:users,{$key}|{$validators}";
        }

        return $rules;
    }
}
