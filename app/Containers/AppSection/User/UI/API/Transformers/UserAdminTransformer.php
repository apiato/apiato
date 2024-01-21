<?php

namespace App\Containers\AppSection\User\UI\API\Transformers;

use App\Containers\AppSection\User\Models\User;

class UserAdminTransformer extends UserTransformer
{
    public function transform(User $user): array
    {
        return parent::transform($user) +
       [
            'real_id' => $user->id,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),
        ];
    }
}
