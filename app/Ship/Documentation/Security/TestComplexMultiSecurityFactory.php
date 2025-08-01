<?php

namespace App\Ship\Documentation\Security;

use App\Ship\Documentation\Security\SecurityRequirements\TestBearerSecurityRequirementFactory;
use App\Ship\Documentation\Security\SecurityRequirements\TestMultiSecurityRequirementFactory;
use MohammadAlavi\LaravelOpenApi\Contracts\Interface\Factories\SecurityFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\Security;

class TestComplexMultiSecurityFactory implements SecurityFactory
{
    public function build(): Security
    {
        return Security::create(
            TestBearerSecurityRequirementFactory::create(),
            TestMultiSecurityRequirementFactory::create(),
        );
    }
}
