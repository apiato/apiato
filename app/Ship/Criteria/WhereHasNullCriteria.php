<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface;

class WhereHasNullCriteria extends Criteria
{
    public function __construct(
        private readonly string $field,
        private readonly string $relation,
    ) {
    }

    /**
     * @param Builder $model
     */
    public function apply($model, RepositoryInterface $repository): Builder
    {
        return $model->whereHas($this->relation, function (Builder $query): void {
            $query->whereNull($this->field);
        });
    }
}
