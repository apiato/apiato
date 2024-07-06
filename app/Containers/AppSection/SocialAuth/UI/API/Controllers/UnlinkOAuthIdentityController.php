<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\Authentication\UI\API\Documentation\SecuritySchemes\BearerTokenSecurityScheme;
use App\Containers\AppSection\Authentication\UI\API\Documentation\SecuritySchemes\OAuth2PasswordClientCredentialsSecurityScheme;
use App\Containers\AppSection\SocialAuth\Actions\UnlinkOAuthIdentityAction;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Parameters\OAuthParameters;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\RequestBodies\UnlinkOAuthIdentityRequestBody;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Responses\UnlinkOAuthIdentityResponse;
use App\Containers\AppSection\SocialAuth\UI\API\Documentation\Tags\SocialAuthTag;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\UnlinkOAuthIdentityRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Documentation\Collections\PrivateCollection;
use MohammadAlavi\LaravelOpenApi\Attributes\Collection;
use MohammadAlavi\LaravelOpenApi\Attributes\Operation;
use MohammadAlavi\LaravelOpenApi\Attributes\Parameters;
use MohammadAlavi\LaravelOpenApi\Attributes\PathItem;
use MohammadAlavi\LaravelOpenApi\Attributes\RequestBody;
use MohammadAlavi\LaravelOpenApi\Attributes\Response;

#[PathItem]
final class UnlinkOAuthIdentityController extends ApiController
{
    public function __construct(
        private readonly UnlinkOAuthIdentityAction $unlinkOAuthIdentityAction,
    ) {
    }

    #[Operation(
        tags: SocialAuthTag::class,
        security: [OAuth2PasswordClientCredentialsSecurityScheme::class, BearerTokenSecurityScheme::class],
        summary: 'Unlink OAuth Identity',
        description: 'Unlink OAuth Identity from user.',
    )]
    #[Parameters(OAuthParameters::class)]
    #[RequestBody(UnlinkOAuthIdentityRequestBody::class)]
    #[Response(UnlinkOAuthIdentityResponse::class)]
    #[Collection([PrivateCollection::class])]
    public function __invoke(UnlinkOAuthIdentityRequest $request, string $provider)
    {
        $user = $this->unlinkOAuthIdentityAction->run($provider, $request->social_id);

        return $this->transform($user, UserTransformer::class, [
            'roles',
            'permissions',
            'libraries',
            'member_properties',
            'mautic_tags',
            'oauth_identities',
            // 'roles', 'memberships', 'credit_info', 'credit_subscriptions', 'libraries', 'facebook_account', 'google_account', 'member_properties'
        ]);
    }
}
