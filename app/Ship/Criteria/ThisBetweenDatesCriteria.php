<?php

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Carbon\Carbon;

class ThisBetweenDatesCriteria extends ParentCriteria
{
    public function __construct(
        private string $field,
        private Carbon $start,
        private Carbon $end,
    ) {
    }

    public function apply($model, $repository)
    {
        return $model->whereBetween($this->field, [$this->start->toDateString(), $this->end->toDateString()]);
    }
}
