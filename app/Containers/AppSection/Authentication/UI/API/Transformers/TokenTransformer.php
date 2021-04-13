<?php

namespace App\Containers\AppSection\Authentication\UI\API\Transformers;

use App\Ship\Parents\Transformers\Transformer;

class TokenTransformer extends Transformer
{
    public function transform($token): array
    {
        $response = [
            'object' => 'Token',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => config('apiato.api.expires-in'),
        ];

        return $response;
    }
}
