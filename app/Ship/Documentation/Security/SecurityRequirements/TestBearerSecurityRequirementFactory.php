<?php

namespace App\Ship\Documentation\Security\SecurityRequirements;

use App\Ship\Documentation\Security\SecuritySchemes\TestBearerSecuritySchemeFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Contracts\Abstract\Factories\Composable\SecurityRequirementFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\RequiredSecurity;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\SecurityRequirement;

/**
 * @extends SecurityRequirementFactory<SecurityRequirement>
 */
final class TestBearerSecurityRequirementFactory extends SecurityRequirementFactory
{
    public function object(): SecurityRequirement
    {
        return SecurityRequirement::create(
            RequiredSecurity::create(
                TestBearerSecuritySchemeFactory::create(),
            ),
        );
    }
}
