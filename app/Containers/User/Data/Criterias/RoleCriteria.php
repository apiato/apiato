<?php

namespace App\Containers\User\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class RoleCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoleCriteria extends Criteria
{

    /**
     * @var string
     */
    private $roles;

    /**
     * RoleCriteria constructor.
     *
     * @param $roles
     */
    public function __construct($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereHas('roles', function ($q) {
            $q->where('name', $this->roles);
        });
    }
}
