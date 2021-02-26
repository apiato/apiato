<?php

namespace App\Containers\Authentication\UI\API\Transformers;

use App\Ship\Parents\Transformers\Transformer;
use Illuminate\Support\Facades\Config;

/**
 * Class TokenTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class TokenTransformer extends Transformer
{
    public function transform($token): array
    {
        $response = [
            'object' => 'Token',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Config::get('apiato.api.expires-in'),
        ];

        return $response;
    }

}
