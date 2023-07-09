<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser;

class ApiLogoutAction extends ParentAction
{
    public function __construct(
        private readonly Parser $parser,
        private readonly TokenRepository $tokenRepository,
        private readonly RefreshTokenRepository $refreshTokenRepository,
    ) {
    }

    public function run(LogoutRequest $request): void
    {
        $id = $this->parser->parse($request->bearerToken())->claims()->get('jti');
        $this->tokenRepository->revokeAccessToken($id);
        $this->refreshTokenRepository->revokeRefreshTokensByAccessTokenId($id);
    }
}
