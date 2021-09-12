<?php

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Carbon\Carbon;

class ThisBetweenDatesCriteria extends Criteria
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
