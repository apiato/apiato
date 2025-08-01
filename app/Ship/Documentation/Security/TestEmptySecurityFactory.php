<?php

namespace App\Ship\Documentation\Security;

use MohammadAlavi\LaravelOpenApi\Contracts\Interface\Factories\SecurityFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\Security;

class TestEmptySecurityFactory implements SecurityFactory
{
    public function build(): Security
    {
        return Security::create();
    }
}
