<?php

namespace App\Containers\Authorization\Data\Repositories;

use App\Containers\Authorization\Models\Role;
use App\Port\Repository\Abstracts\Repository;

/**
 * Class RoleRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoleRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }
}
