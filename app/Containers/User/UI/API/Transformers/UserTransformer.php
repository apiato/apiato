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
            'id'         => (int)$user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'confirmed'  => $user->confirmed,
            'token'      => $user->token,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }
}
