<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Documentation\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use MohammadAlavi\LaravelOpenApi\Factories\ParametersFactory;

class OAuthParameters extends ParametersFactory
{
    public function build(): array
    {
        return [
            Parameter::path()
                ->name('provider')
                ->required()
                ->schema(Schema::string()->enum('google', 'facebook')),
        ];
    }
}
