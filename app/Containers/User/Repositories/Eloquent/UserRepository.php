<?php

namespace App\Containers\User\Repositories\Eloquent;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Models\User;
use App\Kernel\Repository\Abstracts\Repository;

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
