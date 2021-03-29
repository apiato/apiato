<?php

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class CountCriteria extends Criteria
{
    private string $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function apply($model, PrettusRepositoryInterface $repository): Builder
    {
        return DB::table($model->getModel()->getTable())->select($this->field, DB::raw('count(' . $this->field . ') as total_count'))->groupBy($this->field);
    }
}
