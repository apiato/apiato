<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class ExtractLoginCustomAttributeTask extends Task
{
    public function run(array $data): array
    {
        $prefix = Config::get('authentication-container.login.prefix', '');
        $allowedLoginFields = Config::get('authentication-container.login.attributes');
        if (!$allowedLoginFields) {
            $allowedLoginFields = ['email' => []];
        }

        $fields = array_keys($allowedLoginFields);
        $loginUsername = null;
        // The original attribute that which the user tried to log in witch
        // eg 'email', 'name', 'phone'
        $loginAttribute = null;

        // Find first login custom attribute (allowed login field) found in request
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
            'username' => $loginUsername,
            'loginAttribute' => $loginAttribute,
        ];
    }
}
