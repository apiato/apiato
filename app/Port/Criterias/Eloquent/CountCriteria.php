<?php

namespace App\Port\Criterias\Eloquent;

use App\Port\Criterias\Abstracts\Criteria;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class CountCriteria
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CountCriteria extends Criteria
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
        return DB::table($model->getModel()->getTable())->select('*', DB::raw('count('.$this->field.') as total_count'))->groupBy($this->field);
    }
}
