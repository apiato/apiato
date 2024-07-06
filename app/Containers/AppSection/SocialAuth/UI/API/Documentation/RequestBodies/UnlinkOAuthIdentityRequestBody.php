<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Documentation\RequestBodies;

use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Schemas\UnlinkOAuthIdentitySchema;
use App\Ship\Documentation\API\GeneralMediaTypes;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use MohammadAlavi\LaravelOpenApi\Factories\RequestBodyFactory;

class UnlinkOAuthIdentityRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()->content(...GeneralMediaTypes::for(UnlinkOAuthIdentitySchema::ref()));
    }
}
