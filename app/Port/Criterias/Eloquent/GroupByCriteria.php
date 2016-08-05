<?php

namespace App\Port\Criterias\Eloquent;

use App\Port\Criterias\Abstracts\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class GroupByCriteria
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GroupByCriteria extends Criteria
{

    /**
     * @var
     */
    private $field;

    /**
     * ThisFieldCriteria constructor.
     *
     * @param $field
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->groupBy($this->field);
    }
}
