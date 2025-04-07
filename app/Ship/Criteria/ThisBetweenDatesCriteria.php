<?php

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Carbon\CarbonImmutable;

class ThisBetweenDatesCriteria extends ParentCriteria
{
    public function __construct(
        private string $field,
        private CarbonImmutable $start,
        private CarbonImmutable $end,
    ) {
    }

    public function apply($model, $repository)
    {
        return $model->whereBetween($this->field, [$this->start->toDateString(), $this->end->toDateString()]);
    }
}
