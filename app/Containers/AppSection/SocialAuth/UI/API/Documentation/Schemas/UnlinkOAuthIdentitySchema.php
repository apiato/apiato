<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Documentation\Schemas;

use App\Containers\AppSection\SocialAuth\UI\API\Requests\UnlinkOAuthIdentityRequest;
use App\Ship\Documentation\API\RuleExtractor;
use App\Ship\Documentation\Collections\PrivateCollection;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use MohammadAlavi\LaravelOpenApi\Attributes\Collection;
use MohammadAlavi\LaravelOpenApi\Contracts\Reusable;
use MohammadAlavi\LaravelOpenApi\Factories\SchemaFactory;

#[Collection([PrivateCollection::class])]
class UnlinkOAuthIdentitySchema extends SchemaFactory implements Reusable
{
    /**
     * @throws InvalidArgumentException
     */
    public function build(): SchemaContract
    {
        return Schema::object(class_basename($this))
            ->properties(
                Schema::string('social_id')
                    ->description(RuleExtractor::getRuleFrom(UnlinkOAuthIdentityRequest::class, 'social_id')),
            )
            ->required('social_id');
    }
}
