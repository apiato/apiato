<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;
use Illuminate\Database\Query\Builder;

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
        $this->separator = $separator;
        $this->wildcard = $wildcard;
    }

    /**
     * Applies the criteria - if more than one value is separated by the configured separator we will "OR" all the params.
     *
     * @param  Builder $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where(function ($query) {
            $values = explode($this->separator, $this->valueString);
            $query->where($this->field, 'LIKE', str_replace($this->wildcard, '%', array_shift($values)));
            foreach ($values as $value)
                $query->orWhere($this->field, 'LIKE', str_replace($this->wildcard, '%', $value));
        });
    }

}