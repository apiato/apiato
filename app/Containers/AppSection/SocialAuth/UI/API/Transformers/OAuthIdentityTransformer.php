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
            'provider' => $entity->provider,
            'social_id' => $entity->social_id,
            'email' => $entity->email,
            'scopes' => $entity->scopes,
        ];
    }
}
