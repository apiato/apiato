<?php

namespace App\Containers\Settings\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class OrderByKeyAscendingCriteria.
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class OrderByKeyAscendingCriteria extends Criteria
{
    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->orderBy('key', 'asc');
    }
}
