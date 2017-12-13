<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Database\Query\Builder;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisLikeThatCriteria
 * 
 * @author Fabian Widmann <fabian.widmann@gmail.com>
 *
 * Retrieves all entities where $field contains one or more of the given items in $valueString.
 */
class ThisLikeThatCriteria extends Criteria
{

    /**
     * @var string name of the column
     */
    private $field;

    /**
     * @var string contains values separated by $separator
     */
    private $valueString;

    /**
     * @var string separates separate items in the given $values string. Default is csv.
     */
    private $separator;

    /**
     * @var string this character is replaced with '%'. Default is *.
     */
    private $wildcard;


    public function __construct($field, $valueString, $separator = ',', $wildcard = '*')
    {
        $this->field = $field;
        $this->valueString = $valueString;
        $this->separator =$separator;
        $this->wildcard =$wildcard;
    }

    /**
     * Applies the criteria - if more than one value is separated by the configured separator we will "OR" all the params.
     * 
     * @param  $model
     * @param  $repository
     * 
     * @return  mixed
     */
    public function apply($model, $repository)
    {
        $values = explode(config($this->separator), $this->valueString);
        $model = $model->where($this->field, 'LIKE', str_replace($this->wildcard, '%', array_shift($values)));
        foreach ($values as $value)
            $model = $model->orWhere($this->field, 'LIKE', str_replace($this->wildcard, '%', $value));
        return $model;
    }

}
