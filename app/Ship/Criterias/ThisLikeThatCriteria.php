<?php

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria as ParentCriteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Retrieves all entities where $field contains one or more of the given items in $valueString.
 */
class ThisLikeThatCriteria extends ParentCriteria
{
    public function __construct(
        private readonly string $field,
        private readonly string $value,
        private readonly string $separator = ',',
        private readonly string $wildcard = '*',
    ) {
    }

    /**
     * Applies the criteria - if more than one value is separated by the configured separator we will "OR" all the params.
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where(function ($query) {
            $values = explode($this->separator, $this->value);
            $query->where($this->field, 'LIKE', str_replace($this->wildcard, '%', array_shift($values)));
            foreach ($values as $value) {
                $query->orWhere($this->field, 'LIKE', str_replace($this->wildcard, '%', $value));
            }
        });
    }
}
