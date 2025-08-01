<?php

namespace App\Ship\Documentation\Security;

use App\Ship\Documentation\Security\SecurityRequirements\TestApiKeySecurityRequirementFactory;
use App\Ship\Documentation\Security\SecurityRequirements\TestBearerSecurityRequirementFactory;
use MohammadAlavi\LaravelOpenApi\Contracts\Interface\Factories\SecurityFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\Security;

class TestSimpleMultiSecurityFactory implements SecurityFactory
{
    public function build(): Security
    {
        return Security::create(
            TestBearerSecurityRequirementFactory::create(),
            TestApiKeySecurityRequirementFactory::create(),
        );
    }
}
