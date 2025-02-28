<?php

namespace App\Containers\AppSection\Authentication\UI\API\Transformers;

use App\Containers\AppSection\Authentication\Data\Dto\Token;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

final class TokenTransformer extends ParentTransformer
{
    public function transform(Token $token): array
    {
        return [
            'type' => $token->getResourceKey(),
            'token_type' => $token->tokenType,
            'access_token' => $token->accessToken,
            'refresh_token' => $token->refreshToken,
            'expires_in' => $token->expiresIn,
        ];
    }
}
