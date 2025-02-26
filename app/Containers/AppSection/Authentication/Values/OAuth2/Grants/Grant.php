<?php

namespace App\Containers\AppSection\Authentication\Values\OAuth2\Grants;

interface Grant
{
    public function toArray(): array;

    public function grantType(): string;

    public function scope(): string;
}
