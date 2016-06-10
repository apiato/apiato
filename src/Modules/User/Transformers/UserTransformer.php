<?php

namespace Hello\Modules\User\Transformers;

use Hello\Modules\User\Models\User;
use Hello\Services\Core\Transformer\Abstracts\Transformer;

/**
 * Class UserTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserTransformer extends Transformer
{

    /**
     * @param \Hello\Modules\User\Models\User $user
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
