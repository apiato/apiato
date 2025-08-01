<?php

namespace App\Containers\AppSection\Authentication\UI\API\Documentation\Schemas\Properties;

use App\Ship\Documentation\Collections\PrivateCollection;
use MohammadAlavi\LaravelOpenApi\Attributes\Collection;
use MohammadAlavi\ObjectOrientedJSONSchema\Draft202012\Contracts\JSONSchema;
use MohammadAlavi\ObjectOrientedJSONSchema\Draft202012\Formats\StringFormat;
use MohammadAlavi\ObjectOrientedOpenAPI\Contracts\Abstract\Factories\Components\SchemaFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Contracts\Interface\ShouldBeReferenced;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Schema\Schema;

#[Collection([PrivateCollection::class])]
class EmailPropertySchema extends SchemaFactory implements ShouldBeReferenced
{
    public function component(): JSONSchema
    {
        return Schema::string()
            ->format(StringFormat::EMAIL)
            ->description('email')
            ->examples('admin@laragen.io');
    }
}
