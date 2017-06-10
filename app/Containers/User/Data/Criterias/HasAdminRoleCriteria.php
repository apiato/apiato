<?php

namespace App\Containers\User\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class HasAdminRoleCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class HasAdminRoleCriteria extends Criteria
{

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        });
    }
}
