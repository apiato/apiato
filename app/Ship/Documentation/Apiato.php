<?php

namespace App\Ship\Documentation;

use App\Ship\Documentation\Security\Scopes\OrderShippingAddressScope;
use App\Ship\Documentation\Security\Scopes\OrderShippingStatusScope;
use App\Ship\Documentation\Security\SecuritySchemes\TestBearerSecuritySchemeFactory;
use App\Ship\Documentation\Security\SecuritySchemes\TestOAuth2PasswordSecuritySchemeFactory;
use MohammadAlavi\LaravelOpenApi\Factories\OpenAPIFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Extensions\Extension;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Contact\Contact;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Info\Info;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\License\License;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\OpenAPI\OpenAPI;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\Security;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\RequiredSecurity;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityRequirement\SecurityRequirement;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Security\SecurityScheme\OAuth\ScopeCollection;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Server\Server;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Tag\Tag;

final readonly class Apiato extends OpenAPIFactory
{
    public function instance(): OpenAPI
    {
        return OpenAPI::v311(
            Info::create(
                'https://laragen.io',
                '1.0.0',
            )->summary('Default OpenAPI Specification')
                ->description(
                    'This is the default OpenAPI specification for the application.',
                )->contact(
                    Contact::create()
                        ->name('Example Contact')
                        ->email('example@example.com')
                        ->url('https://example.com/'),
                )->license(
                    License::create('MIT')
                        ->url('https://github.com/'),
                ),
        )->servers(
            Server::create('https://laragen.io'),
        )->security(
            Security::create(
                SecurityRequirement::create(
                    RequiredSecurity::create(
                        TestBearerSecuritySchemeFactory::create(),
                    ),
                ),
                SecurityRequirement::create(
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
                ),
            ),
        )->tags(
            Tag::create('test')->description('This is a test tag.'),
        )->addExtension(
            Extension::create('x-example', [
                'name' => 'General',
                'tags' => [
                    'user',
                ],
            ]),
        );
    }
}
