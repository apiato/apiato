<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\Stateless\LoginByCodeAction;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Parameters\OAuthParameters;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\RequestBodies\OAuthRequestBody;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Responses\UserWithTokenResponse;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Tags\SocialAuthTag;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\LoginByCodeRequest;
use App\Containers\AppSection\SocialAuth\Values\PersonalAccessTokenResponse;
use App\Containers\AppSection\SocialAuth\Values\SuccessfulSocialAuthOutcome;
use App\Ship\Documentation\Collections\PrivateCollection;
use MohammadAlavi\LaravelOpenApi\Attributes\Collection;
use MohammadAlavi\LaravelOpenApi\Attributes\Operation;
use MohammadAlavi\LaravelOpenApi\Attributes\Parameters;
use MohammadAlavi\LaravelOpenApi\Attributes\PathItem;
use MohammadAlavi\LaravelOpenApi\Attributes\RequestBody;
use MohammadAlavi\LaravelOpenApi\Attributes\Response;

#[PathItem]
final class LoginByCodeController extends ApiController
{
    public function __construct(
        private readonly LoginByCodeAction $statelessLoginByCodeAction,
    ) {
    }

    #[Operation(
        tags: SocialAuthTag::class,
        security: [],
        summary: 'Login by authorization code',
        description: 'Login by authorization code',
    )]
    #[Parameters(OAuthParameters::class)]
    #[RequestBody(OAuthRequestBody::class)]
    #[Response(UserWithTokenResponse::class)]
    #[Collection([PrivateCollection::class])]
    public function __invoke(LoginByCodeRequest $request, string $provider)
    {
        /* @var SuccessfulSocialAuthOutcome $result */
        $result = $this->statelessLoginByCodeAction->transactionalRun($provider);

        return $this->withMeta(
            PersonalAccessTokenResponse::from($result->token())->toArray(),
        )->transform($result->user(), SocialAuth::userTransformer());
    }
}
