<?php

namespace App\Ship\Documentation\Security\SecuritySchemes;

use App\Ship\Documentation\Security\Scopes\OrderItemScope;
use App\Ship\Documentation\Security\Scopes\OrderPaymentScope;
use App\Ship\Documentation\Security\Scopes\OrderScope;
use App\Ship\Documentation\Security\Scopes\OrderShippingAddressScope;
use App\Ship\Documentation\Security\Scopes\OrderShippingStatusScope;
use MohammadAlavi\ObjectOrientedOpenAPI\Contracts\Abstract\Factories\Components\SecuritySchemeFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\Flows\AuthorizationCode;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\OAuthFlows;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\ScopeCollection;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\Schemes\OAuth2;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\SecurityScheme;

class ExampleOAuth2AuthorizationCodeSecurityScheme extends SecuritySchemeFactory
{
    public function component(): SecurityScheme
    {
        return SecurityScheme::oAuth2(
            OAuth2::create(
                OAuthFlows::create(
                    authorizationCode: AuthorizationCode::create(
                        'https://laragen.io/oauth/authorize',
                        'https://laragen.io/oauth/token',
                        null,
                        ScopeCollection::create(
                            OrderScope::create(),
                            OrderItemScope::create(),
                            OrderPaymentScope::create(),
                            OrderShippingAddressScope::create(),
                            OrderShippingStatusScope::create(),
                        ),
                    ),
                ),
            ),
        );
    }
}
