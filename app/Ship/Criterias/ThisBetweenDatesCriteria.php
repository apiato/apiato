<?php

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Carbon\Carbon;

class ThisBetweenDatesCriteria extends Criteria
{
    private Carbon $start;

    private Carbon $end;

    private string $field;


    public function __construct(string $field, Carbon $start, Carbon $end)
    {
        $this->start = $start;
        $this->end = $end;
        $this->field = $field;
    }

    public function apply($model, $repository)
    {
        return $model->whereBetween($this->field, [$this->start->toDateString(), $this->end->toDateString()]);
    }
}
