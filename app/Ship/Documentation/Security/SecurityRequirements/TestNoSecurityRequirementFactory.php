<?php

namespace App\Ship\Documentation\Security\SecurityRequirements;

use MohammadAlavi\ObjectOrientedOpenAPI\Contracts\Abstract\Factories\Composable\SecurityRequirementFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\SecurityRequirement;

/**
 * @extends SecurityRequirementFactory<SecurityRequirement>
 */
final class TestNoSecurityRequirementFactory extends SecurityRequirementFactory
{
    public function object(): SecurityRequirement
    {
        return SecurityRequirement::create();
    }
}
