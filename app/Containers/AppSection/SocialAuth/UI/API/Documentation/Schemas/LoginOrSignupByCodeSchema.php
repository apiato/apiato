<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Documentation\Schemas;

use App\Containers\AppSection\SocialAuth\UI\API\Requests\LoginOrSignupByCodeRequest;
use App\Ship\Documentation\API\RuleExtractor;
use App\Ship\Documentation\Collections\PrivateCollection;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use MohammadAlavi\LaravelOpenApi\Attributes\Collection;
use MohammadAlavi\LaravelOpenApi\Contracts\Reusable;
use MohammadAlavi\LaravelOpenApi\Factories\SchemaFactory;

#[Collection([PrivateCollection::class])]
class LoginOrSignupByCodeSchema extends SchemaFactory implements Reusable
{
    public function build(): SchemaContract
    {
        return Schema::object(class_basename($this))
            ->properties(
                Schema::string('code')
                    ->description(RuleExtractor::getRuleFrom(LoginOrSignupByCodeRequest::class, 'code')),
                Schema::string('access_token')
                    ->description(RuleExtractor::getRuleFrom(LoginOrSignupByCodeRequest::class, 'access_token')),
                Schema::string('email')->nullable()
                    ->description(RuleExtractor::getRuleFrom(LoginOrSignupByCodeRequest::class, 'email')),
                Schema::string('redirect_url')->enum(...config('appSection-socialAuth.allowed-redirect-urls'))
                    ->description(RuleExtractor::getRuleFrom(LoginOrSignupByCodeRequest::class, 'redirect_url')),
            );
    }
}
