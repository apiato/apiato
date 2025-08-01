<?php

namespace App\Ship\Documentation\Security\Scopes;

use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\Scope;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\ScopeFactory;

final readonly class OrderItemScope extends ScopeFactory
{
    public function build(): Scope
    {
        return Scope::create('order:item', 'Information about items within an order.');
    }
}
