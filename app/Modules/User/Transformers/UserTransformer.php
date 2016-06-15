<?php

namespace App\Modules\User\Transformers;

use App\Modules\User\Models\User;
use App\Modules\Core\Transformer\Abstracts\Transformer;

/**
 * Class UserTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserTransformer extends Transformer
{

    /**
     * @param \App\Modules\User\Models\User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'         => (int)$user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'token'      => $user->token,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];
    }
}
