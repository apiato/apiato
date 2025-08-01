<?php

namespace App\Ship\Documentation\Security\Scopes;

use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\Scope;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\ScopeFactory;

final readonly class OrderShippingAddressScope extends ScopeFactory
{
    public function build(): Scope
    {
        return Scope::create('order:shipping:address', 'Information about where to deliver orders.');
    }
}
