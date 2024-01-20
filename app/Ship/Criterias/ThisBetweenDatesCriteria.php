<?php

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria as ParentCriteria;
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
