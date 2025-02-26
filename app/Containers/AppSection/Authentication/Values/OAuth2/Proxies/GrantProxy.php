<?php

namespace App\Containers\AppSection\Authentication\Values\OAuth2\Proxies;

use App\Containers\AppSection\Authentication\Values\OAuth2\Grants\Grant;

interface GrantProxy
{
    public function grant(): Grant;
}
