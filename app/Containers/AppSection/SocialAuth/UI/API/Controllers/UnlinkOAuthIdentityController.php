<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\UnlinkOAuthIdentityAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\UnlinkOAuthIdentityRequest;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class UnlinkOAuthIdentityController extends ApiController
{
    public function __construct(
        private readonly UnlinkOAuthIdentityAction $unlinkOAuthIdentityAction,
    ) {
    }

    public function __invoke(UnlinkOAuthIdentityRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        $this->unlinkOAuthIdentityAction->transactionalRun($provider, $request->social_id);

        return $this->noContent();
    }
}
