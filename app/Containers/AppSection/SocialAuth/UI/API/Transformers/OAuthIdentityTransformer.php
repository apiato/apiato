<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Transformers;

use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

final class OAuthIdentityTransformer extends ParentTransformer
{
    private $token;

    public function __construct($token = null)
    {
        $this->token = $token;
    }

    public function transform(OAuthIdentity $entity): array
    {
        return [
            'object' => $entity->getResourceKey(),
            'id' => $entity->getHashedKey(),
            'user_id' => $entity->getHashedKey('user_id'),
            'provider' => $entity->getProvider(),
            // 'social_id' => $entity->getSocialId(),
            'nickname' => $entity->getNickname(),
            'name' => $entity->getName(),
            'email' => $entity->getEmail(),
            'avatar' => $entity->getAvatar(),
            'access_token' => $this->token,
        ];
    }
}
