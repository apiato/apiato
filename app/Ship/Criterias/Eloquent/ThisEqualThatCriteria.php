<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisEqualThatCriteria
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ThisEqualThatCriteria extends Criteria
{

    /**
     * @var
     */
    private $field;

    /**
     * @var
     */
    private $value;

    /**
     * ThisEqualThatCriteria constructor.
     *
     * @param $field
     * @param $value
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where($this->field, $this->value);
    }

}
