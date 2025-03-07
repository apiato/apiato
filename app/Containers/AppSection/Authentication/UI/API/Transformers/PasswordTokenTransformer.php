<?php

namespace App\Containers\AppSection\Authentication\UI\API\Transformers;

use App\Containers\AppSection\Authentication\Data\DTOs\PasswordToken;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

final class PasswordTokenTransformer extends ParentTransformer
{
    public function transform(PasswordToken $token): array
    {
        return [
            'type' => $token->getResourceKey(),
            'token_type' => $token->tokenType,
            'access_token' => $token->accessToken,
            'refresh_token' => $token->refreshToken->value(),
            'expires_in' => $token->expiresIn,
        ];
    }
}
