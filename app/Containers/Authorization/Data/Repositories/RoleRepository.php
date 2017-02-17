<?php

namespace App\Containers\Authorization\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class RoleRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoleRepository extends Repository
{

    /**
     * the container name. Must be set when the model has different name than the container
     *
     * @var  string
     */
    protected $container = 'Authorization';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'         => '=',
        'display_name' => 'like',
        'description'  => 'like',
    ];

}
