<?php

namespace App\Ship\Documentation\Security\SecurityRequirements;

use App\Ship\Documentation\Security\SecuritySchemes\TestApiKeySecuritySchemeFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Contracts\Abstract\Factories\Composable\SecurityRequirementFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\RequiredSecurity;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\SecurityRequirement;

/**
 * @extends SecurityRequirementFactory<SecurityRequirement>
 */
final class TestApiKeySecurityRequirementFactory extends SecurityRequirementFactory
{
    public function object(): SecurityRequirement
    {
        return SecurityRequirement::create(
            RequiredSecurity::create(
                TestApiKeySecuritySchemeFactory::create(),
            ),
        );
    }
}
