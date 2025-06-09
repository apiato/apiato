<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class BelongsToRelationCriteria extends ParentCriteria
{
    public function __construct(
        protected readonly mixed $value,
        protected readonly string $relationColumn,
        protected readonly string $relation,
        protected readonly string $condition = '=',
    ) {
    }

    /**
     * @param Builder $model
     */
    public function apply($model, PrettusRepositoryInterface $repository): Builder
    {
        return $model->whereHas($this->relation, function (Builder $query): void {
            $query->where($this->relationColumn, $this->condition, $this->value);
        });
    }
}
