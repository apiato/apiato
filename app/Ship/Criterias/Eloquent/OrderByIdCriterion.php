<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class OrderByIdCriterion
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class OrderByIdCriterion extends Criteria
{
    private $direction;

    public function __construct($direction = 'asc')
    {
        if (($direction != 'asc') && ($direction != 'desc')) {
            $direction = 'asc';
        }

        $this->direction = $direction;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->orderBy('id', $this->direction);
    }

}
