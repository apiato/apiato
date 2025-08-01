<?php

namespace App\Ship\Documentation\Security\SecuritySchemes;

use MohammadAlavi\ObjectOrientedOpenAPI\Contracts\Abstract\Factories\Components\SecuritySchemeFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\Schemes\Http;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\SecurityScheme;

class TestBearerSecuritySchemeFactory extends SecuritySchemeFactory
{
    public function component(): SecurityScheme
    {
        return SecurityScheme::http(Http::bearer())
            ->description('Example Security');
    }
}
