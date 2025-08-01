<?php

namespace App\Ship\Documentation\Security\Scopes;

use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\Scope;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\ScopeFactory;

final readonly class OrderScope extends ScopeFactory
{
    public function build(): Scope
    {
        return Scope::create('order', 'Full information about orders.');
    }
}
