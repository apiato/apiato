<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Documentation\RequestBodies;

use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Schemas\LoginOrSignupByCodeSchema;
use App\Ship\Documentation\API\GeneralMediaTypes;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use MohammadAlavi\LaravelOpenApi\Factories\RequestBodyFactory;

class LoginOrSignupByCodeRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()->content(...GeneralMediaTypes::for(LoginOrSignupByCodeSchema::ref()));
    }
}
