<?php

namespace App\Containers\AppSection\Authentication\Traits;

trait LoginAttributeCaseSensitivityTrait
{
    /**
     * @param string $username
     * @return string
     */
    private function processLoginAttributeCaseSensitivity(string $username): string
    {
        return config('appSection-authentication.login.case_sensitive') ? $username : strtolower($username);
    }
}
