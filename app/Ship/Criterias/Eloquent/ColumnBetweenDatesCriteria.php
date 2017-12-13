<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;

/**
 * Class ColumnBetweenDatesCriteria
 * @package App\Containers\WeatherData\Data\Criterias
 * @author Fabian Widmann <fabian.widmann@gmail.com>
 *
 * Retrieves all entities whose date $field's value is between $from and $to.
 */
class ColumnBetweenDatesCriteria extends Criteria
{

    /**
     * @var Carbon
     */
    private $from;

    /**
     * @var Carbon
     */
    private $to;

    /**
     * @var string
     */
    private $field;


    public function __construct($field, Carbon $from, Carbon $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->field = $field;
    }

    /**
     * Applies the criteria
     * @param Builder $model
     * @param  $repository
     * @return  mixed
     */
    public function apply($model, $repository)
    {
        return $model->whereBetween($this->field, [$this->from->toDateString(), $this->to->toDateString()]);
    }

}