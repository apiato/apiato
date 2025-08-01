<?php

namespace App\Containers\AppSection\Authentication\UI\API\Documentation\Parameters;

use App\Containers\AppSection\Authentication\UI\API\Documentation\Schemas\Properties\EmailPropertySchema;
use MohammadAlavi\LaravelOpenApi\Contracts\Interface\Factories\ParametersFactory;
use MohammadAlavi\ObjectOrientedJSONSchema\Draft202012\Formats\StringFormat;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Parameter\Parameter;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Parameter\SerializationRule\QueryParameter;
use MohammadAlavi\ObjectOrientedOpenAPI\Schema\Objects\Schema\Schema;
use MohammadAlavi\ObjectOrientedOpenAPI\Support\SharedFields\Parameters;

class RegisterUserParams implements ParametersFactory
{
    public function build(): Parameters
    {
        return Parameters::create(
            Parameter::query(
                'email',
                QueryParameter::create(
                    EmailPropertySchema::create(),
                ),
            )->required(),
            Parameter::query(
                'password',
                QueryParameter::create(
                    Schema::string()
                        ->format(StringFormat::PASSWORD),
                ),
            )->required(),
            Parameter::query(
                'name',
                QueryParameter::create(
                    Schema::string()
                        ->minLength(2)
                        ->maxLength(50),
                ),
            ),
            Parameter::query(
                'verification_url',
                QueryParameter::create(
                    Schema::string()
                        ->enum(
                            'https://example.com/verify-email',
                            'https://example.com/verify-email?token=123456',
                        ),
                ),
            ),
        );
    }
}
