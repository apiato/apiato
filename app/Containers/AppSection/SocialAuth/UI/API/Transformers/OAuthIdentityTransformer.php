<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Transformers;

use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

final class OAuthIdentityTransformer extends ParentTransformer
{
    public function transform(OAuthIdentity $entity): array
    {
        return [
            'object' => $entity->getResourceKey(),
            'id' => $entity->getHashedKey(),
            'provider' => $entity->getProvider(),
            'social_id' => $entity->getSocialId(),
            'nickname' => $entity->getNickname(),
            'name' => $entity->getName(),
            'email' => $entity->getEmail(),
            'avatar' => $entity->getAvatar(),
        ];
    }
}
