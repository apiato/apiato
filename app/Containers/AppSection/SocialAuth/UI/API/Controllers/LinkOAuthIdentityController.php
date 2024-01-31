<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController;
use App\Containers\AppSection\SocialAuth\Actions\LinkOAuthIdentityAction;
use App\Containers\AppSection\SocialAuth\UI\API\Requests\LinkOAuthIdentityRequest;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;

final class LinkOAuthIdentityController extends ApiController
{
    public function __construct(
        private readonly LinkOAuthIdentityAction $linkOAuthIdentityAction,
    ) {
    }

    public function __invoke(LinkOAuthIdentityRequest $request, string $provider)
    {
        /* @var SocialAuthOutcome $result */
        $this->linkOAuthIdentityAction->transactionalRun($provider);

        return $this->noContent();
    }
}
