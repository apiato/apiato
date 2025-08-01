<?php

namespace App\Containers\AppSection\User\UI\API\Documentation\Parameters;

use MohammadAlavi\LaravelOpenApi\Contracts\Interface\Factories\ParametersFactory;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Parameter\Parameter;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Parameter\SerializationRule\PathParameter;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Schema\Schema;
use MohammadAlavi\ObjectOrientedOpenAPI\Support\SharedFields\Parameters;

final class UpdateUserParams implements ParametersFactory
{
    public function build(): Parameters
    {
        return Parameters::create(
            Parameter::path(
                'id',
                PathParameter::create(
                    Schema::string(),
                ),
            )->description('User ID')
                ->required(),
        );
    }
}
