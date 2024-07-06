<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\Authentication\Actions\LoginAsUserAction;
use App\Containers\AppSection\SocialAuth\Actions\Stateless\LoginOrSignupByCodeAction;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Parameters\OAuthParameters;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\RequestBodies\LoginOrSignupByCodeRequestBody;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Responses\UserWithTokenResponse;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Tags\SocialAuthTag;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\LoginOrSignupByCodeRequest;
use App\Containers\AppSection\SocialAuth\UI\API\Transformers\OAuthIdentityTransformer;
use App\Containers\AppSection\SocialAuth\Values\FailedSocialAuthOutcome;
use App\Containers\AppSection\SocialAuth\Values\SuccessfulSocialAuthOutcome;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Documentation\Collections\PrivateCollection;
use Illuminate\Http\JsonResponse;
use MohammadAlavi\LaravelOpenApi\Attributes\Collection;
use MohammadAlavi\LaravelOpenApi\Attributes\Operation;
use MohammadAlavi\LaravelOpenApi\Attributes\Parameters;
use MohammadAlavi\LaravelOpenApi\Attributes\PathItem;
use MohammadAlavi\LaravelOpenApi\Attributes\RequestBody;
use MohammadAlavi\LaravelOpenApi\Attributes\Response;

#[PathItem]
final class LoginOrSignupByCodeController extends ApiController
{
    public function __construct(
        private readonly LoginOrSignupByCodeAction $statelessLoginOrSignupByCodeAction,
        private readonly LoginAsUserAction $loginAsUserAction,
    ) {
    }

    #[Operation(
        tags: SocialAuthTag::class,
        security: [],
        summary: 'Login or signup by authorization code',
        description: 'Login or signup by authorization code',
    )]
    #[Parameters(OAuthParameters::class)]
    #[RequestBody(LoginOrSignupByCodeRequestBody::class)]
    #[Response(UserWithTokenResponse::class)]
    #[Collection([PrivateCollection::class])]
    public function __invoke(LoginOrSignupByCodeRequest $request, string $provider): JsonResponse|array
    {
        /* @var SuccessfulSocialAuthOutcome|FailedSocialAuthOutcome $result */
        $result = $this->statelessLoginOrSignupByCodeAction->transactionalRun($request, $provider);

        if ($result->user()) {
            $loginResult = $this->loginAsUserAction->transactionalRun($result->user()->id);
            $transformedUser = $this->transform($result->user(), UserTransformer::class, [
                'roles',
                'permissions',
                'libraries',
                'member_properties',
                'mautic_tags',
                'oauth_identities',
                // 'roles', 'memberships', 'credit_info', 'credit_subscriptions', 'libraries', 'facebook_account', 'google_account', 'member_properties'
            ]);
            $response = [
                'user' => $transformedUser,
                'tokens' => $loginResult['tokens'],
            ];

            return $this->json($response)->withCookie($loginResult['refresh_cookie']);
        }

        return $this->transform($result->oAuthIdentity(), new OAuthIdentityTransformer($result->token()));
    }
}
