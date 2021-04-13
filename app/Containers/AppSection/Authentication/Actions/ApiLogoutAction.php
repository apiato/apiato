<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\UI\API\Requests\LogoutRequest;
use App\Ship\Parents\Actions\Action;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser;

class ApiLogoutAction extends Action
{
    public function run(LogoutRequest $request): void
    {
        $id = app(Parser::class)->parse($request->bearerToken())->claims()->get('jti');
        app(TokenRepository::class)->revokeAccessToken($id);
        app(RefreshTokenRepository::class)->revokeRefreshTokensByAccessTokenId($id);
    }
}
