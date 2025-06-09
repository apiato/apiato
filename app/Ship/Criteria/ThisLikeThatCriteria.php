<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Retrieves all entities where $field contains one or more of the given items in $valueString.
 */
class ThisLikeThatCriteria extends ParentCriteria
{
    public function __construct(
        /** Name of the column */
        private readonly string $field,
        /** Contains values separated by */
        private readonly string $value,
        /** Separates separate items in the given string. Default is csv. */
        private readonly string $separator = ',',
        /** This character is replaced with '%'. Default is *. */
        private readonly string $wildcard = '*',
    ) {
    }

    /**
     * Applies the criteria - if more than one value is separated by the configured separator we will "OR" all the params.
     *
     * @param Builder $model
     */
    public function apply($model, PrettusRepositoryInterface $repository): Builder
    {
        return $model->where(function (Builder $query): void {
            $values = explode($this->separator, $this->value);
            $query->where($this->field, 'LIKE', str_replace($this->wildcard, '%', array_shift($values)));
            foreach ($values as $value) {
                $query->orWhere($this->field, 'LIKE', str_replace($this->wildcard, '%', $value));
            }
        });
    }
}
