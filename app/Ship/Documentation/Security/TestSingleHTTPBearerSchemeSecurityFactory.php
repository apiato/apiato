<?php

namespace App\Ship\Documentation\Security;

use App\Ship\Documentation\Security\SecurityRequirements\TestBearerSecurityRequirementFactory;
use MohammadAlavi\LaravelOpenApi\Contracts\Interface\Factories\SecurityFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\Security;

class TestSingleHTTPBearerSchemeSecurityFactory implements SecurityFactory
{
    public function build(): Security
    {
        return Security::create(
            TestBearerSecurityRequirementFactory::create(),
        );
    }
}
