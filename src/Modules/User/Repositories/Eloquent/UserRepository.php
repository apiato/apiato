<?php

namespace Hello\Modules\User\Repositories\Eloquent;

use Hello\Modules\User\Contracts\UserRepositoryInterface;
use Hello\Modules\User\Models\User;
use Hello\Services\Core\Repository\Abstracts\Repository;

/**
 * Class UserRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserRepository extends Repository implements UserRepositoryInterface
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'  => 'like',
        'email' => '=',
    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
