<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class ThisWhereOrWhereThatCriteria extends ParentCriteria
{
    public function __construct(
        /** Names of the column */
        private readonly array $fields,
        /** Contains values */
        private readonly array $values,
    ) {
    }

    /**
     * Applies the criteria - if more than one fields exists we will "OR" all the params.
     *
     * @param Builder $model
     */
    public function apply($model, PrettusRepositoryInterface $repository): Builder
    {
        return $model->where(function (Builder $query): void {
            $values     = array_combine($this->fields, $this->values);
            $firstField = array_key_first($values);
            $firstValue = array_shift($values);

            $query->where($firstField, $firstValue);
            foreach ($values as $field => $value) {
                $query->orWhere($field, $value);
            }
        });
    }
}
