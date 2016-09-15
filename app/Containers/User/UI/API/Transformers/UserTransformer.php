<?php

namespace App\Containers\User\UI\API\Transformers;

use App\Containers\User\Models\User;
use App\Port\Transformer\Abstracts\Transformer;

/**
 * Class UserTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserTransformer extends Transformer
{

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'                   => (int)$user->id,
            'name'                 => $user->name,
            'email'                => $user->email,
            'confirmed'            => $user->confirmed,
            'nickname'             => $user->nickname,
            'gender'               => $user->gender,
            'birth'                => $user->birth,
            'visitor_id'           => $user->visitor_id,
            'social_auth_provider' => $user->social_provider,
            'social_id'            => $user->social_id,
            'social_avatar'        => [
                'avatar'   => $user->social_avatar,
                'original' => $user->social_avatar_original,
            ],
            'created_at'           => $user->created_at,
            'updated_at'           => $user->updated_at,
            'token'                => $user->token,
        ];
    }
}
