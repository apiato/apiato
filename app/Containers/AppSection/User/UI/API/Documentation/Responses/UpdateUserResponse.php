<?php

namespace App\Containers\AppSection\User\UI\API\Documentation\Responses;

use MohammadAlavi\LaravelOpenApi\Contracts\Interface\Factories\ResponsesFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\MediaType\MediaType;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Response\Response;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Responses\Fields\HTTPStatusCode;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Responses\Responses;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Responses\Support\ResponseEntry;
use MohammadAlavi\ObjectOrientedOpenAPI\Support\SharedFields\Content\ContentEntry;

final class UpdateUserResponse implements ResponsesFactory
{
    public function build(): Responses
    {
        return Responses::create(
            ResponseEntry::create(
                HTTPStatusCode::ok(),
                Response::create('User updated successfully')
                    ->content(
                        ContentEntry::json(
                            MediaType::create(),
                        ),
                    ),
            ),
        );
    }
}
