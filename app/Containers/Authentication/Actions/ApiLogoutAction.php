<?php

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser;

class ApiLogoutAction extends Action
{
    public function run(DataTransporter $data): bool
    {
        $id = app(Parser::class)->parse($data->bearerToken)->claims()->get('jti');

        $tokenRepository = app(TokenRepository::class);
        $refreshTokenRepository = app(RefreshTokenRepository::class);

        $tokenRepository->revokeAccessToken($id);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($id);
    }
}
