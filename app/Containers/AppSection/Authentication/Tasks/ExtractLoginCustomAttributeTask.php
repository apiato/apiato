<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Arr;

class ExtractLoginCustomAttributeTask extends Task
{
    public function run(array $data): array
    {
        $prefix = config('appSection-authentication.login.prefix', '');
        $allowedLoginAttributes = $this->getAllowedLoginAttributes();

        $fields = array_keys($allowedLoginAttributes);
        $loginUsername = null;
        // The original attribute the user tried to log in witch
        // eg 'email', 'name', 'phone'
        $loginAttribute = null;

        // Find first login custom attribute (allowed login attributes) found in request
        // eg: search the request exactly in order which they are in 'authentication-container'
        // for 'email' then 'phone' then 'name' in request
        // and put the first one found in 'username' field witch its value as 'username' value
        foreach ($fields as $field) {
            $fieldName = $prefix . $field;
            $loginUsername = Arr::get($data, $fieldName);
            $loginAttribute = $field;

            if ($loginUsername !== null) {
                break;
            }
        }

        return [
            $loginUsername,
            $loginAttribute,
        ];
    }

    private function getAllowedLoginAttributes(): mixed
    {
        $allowedLoginFields = config('appSection-authentication.login.attributes');
        if (!$allowedLoginFields) {
            $allowedLoginFields = ['email' => []];
        }

        return $allowedLoginFields;
    }
}
