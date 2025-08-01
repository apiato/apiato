<?php

namespace App\Containers\AppSection\Authentication\UI\API\Documentation\SecuritySchemes;

use App\Ship\Documentation\Collections\PrivateCollection;
use MohammadAlavi\LaravelOpenApi\Attributes\Collection;
use MohammadAlavi\LaravelOpenApi\Contracts\Interface\Factories\SecurityFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\Security;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\RequiredSecurity;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\SecurityRequirement;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\Schemes\Http;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\SecurityScheme;

#[Collection([PrivateCollection::class])]
final class BearerTokenSecurityScheme implements SecurityFactory
{
    public function build(): Security
    {
        return Security::create(
            SecurityRequirement::create(
                RequiredSecurity::create(
                    SecurityScheme::http(Http::bearer()),
                ),
            ),
        );
    }
}
