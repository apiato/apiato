<?php

namespace App\Ship\Documentation\Security\Scopes;

use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\Scope;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\ScopeFactory;

final readonly class OrderPaymentScope extends ScopeFactory
{
    public function build(): Scope
    {
        return Scope::create('order:payment', 'Access to order payment details.');
    }
}
