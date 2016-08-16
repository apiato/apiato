<?php

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Models\User;
use App\Port\Repository\Abstracts\Repository;

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
        'name'          => 'like',
        'id'            => '=',
        'visitor_id'    => '=',
        'email'         => '=',
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
