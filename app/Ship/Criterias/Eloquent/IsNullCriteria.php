<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class IsNullCriteria
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class IsNullCriteria extends Criteria
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
        return $model->whereNull($this->field);
    }

}
