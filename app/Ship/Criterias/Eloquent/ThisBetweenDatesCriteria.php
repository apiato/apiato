<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;

/**
 * Class ThisBetweenDatesCriteria
 * 
 * @author Fabian Widmann <fabian.widmann@gmail.com>
 *
 * Retrieves all entities whose date $field's value is between $start and $end.
 */
class ThisBetweenDatesCriteria extends Criteria
{

    /**
     * @var Carbon
     */
    private $start;

    /**
     * @var Carbon
     */
    private $end;

    /**
     * @var string
     */
    private $field;


    public function __construct($field, Carbon $start, Carbon $end)
    {
        $this->start = $start;
        $this->end = $end;
        $this->field = $field;
    }

    /**
     * Applies the criteria
     * 
     * @param Builder $model
     * @param         $repository
     * 
     * @return        mixed
     */
    public function apply($model, $repository)
    {
        return $model->whereBetween($this->field, [$this->start->toDateString(), $this->end->toDateString()]);
    }
}
