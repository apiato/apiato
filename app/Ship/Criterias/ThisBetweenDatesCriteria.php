<?php

declare(strict_types=1);

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria as ParentCriteria;
use Carbon\Carbon;

class ThisBetweenDatesCriteria extends ParentCriteria
{
    public function __construct(
        private readonly string $field,
        private readonly Carbon $start,
        private readonly Carbon $end,
    ) {
    }

    public function apply($model, $repository)
    {
        return $model->whereBetween($this->field, [$this->start->toDateString(), $this->end->toDateString()]);
    }
}
