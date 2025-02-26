<?php

namespace App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\PasswordGrant;

use App\Containers\AppSection\Authentication\Values\OAuth2\Grants\PasswordGrant;
use App\Containers\AppSection\Authentication\Values\OAuth2\Grants\RefreshTokenGrant;
use App\Containers\AppSection\Authentication\Values\OAuth2\Proxies\GrantProxy;
use Illuminate\Contracts\Support\Arrayable;

interface PasswordGrantProxy extends GrantProxy, Arrayable
{
    public function grant(): PasswordGrant|RefreshTokenGrant;
}
