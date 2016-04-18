<?php

namespace Mega\Modules\User\Transformers;

use Mega\Services\Core\Transformer\Abstracts\Transformer;
use Mega\Modules\User\Models\User;

/**
 * Class UserTransformer
 *
 * @type Transformer
 * @package  Mega\Interfaces\Api\Transformers
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserTransformer extends Transformer
{

    /**
     * @param \Mega\Modules\User\Models\User $user
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
