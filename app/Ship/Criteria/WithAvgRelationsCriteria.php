<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WithAvgRelationsCriteria extends ParentCriteria
{
    public function __construct(
        private readonly string|array $relations,
        private readonly string $column,
    ) {
    }

    /**
     * @param Builder $model
     */
    public function apply($model, PrettusRepositoryInterface $repository): Builder
    {
        return $model->withAvg($this->relations, $this->column);
    }
}
