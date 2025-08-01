<?php

namespace App\Ship\Documentation\Security\SecurityRequirements;

use App\Ship\Documentation\Security\Scopes\OrderShippingAddressScope;
use App\Ship\Documentation\Security\Scopes\OrderShippingStatusScope;
use App\Ship\Documentation\Security\SecuritySchemes\TestBearerSecuritySchemeFactory;
use App\Ship\Documentation\Security\SecuritySchemes\TestOAuth2PasswordSecuritySchemeFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Contracts\Abstract\Factories\Composable\SecurityRequirementFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\RequiredSecurity;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\SecurityRequirement;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\ScopeCollection;

/**
 * @extends SecurityRequirementFactory<SecurityRequirement>
 */
final class TestMultiSecurityRequirementFactory extends SecurityRequirementFactory
{
    public function object(): SecurityRequirement
    {
        return SecurityRequirement::create(
            RequiredSecurity::create(
                TestBearerSecuritySchemeFactory::create(),
            ),
            RequiredSecurity::create(
                TestOAuth2PasswordSecuritySchemeFactory::create(),
                ScopeCollection::create(
                    OrderShippingAddressScope::create(),
                    OrderShippingStatusScope::create(),
                ),
            ),
        );
    }
}
