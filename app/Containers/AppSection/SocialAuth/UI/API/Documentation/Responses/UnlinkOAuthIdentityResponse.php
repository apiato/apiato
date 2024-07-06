<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Documentation\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use MohammadAlavi\LaravelOpenApi\Factories\ResponseFactory;

class UnlinkOAuthIdentityResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()->content(
            MediaType::json()->schema(
                Schema::object()
                    ->properties(
                        Schema::object('user')
                            ->properties(
                                Schema::string('object')->example('User')
                            ),
                    )
            )
        );
    }
}
