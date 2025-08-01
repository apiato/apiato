<?php

namespace App\Ship\Documentation\Security\SecuritySchemes;

use MohammadAlavi\ObjectOrientedOpenAPI\Contracts\Abstract\Factories\Components\SecuritySchemeFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\Schemes\ApiKey;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\SecurityScheme;

class TestApiKeySecuritySchemeFactory extends SecuritySchemeFactory
{
    public function component(): SecurityScheme
    {
        return SecurityScheme::apiKey(ApiKey::cookie('ApiKey Security'));
    }
}
