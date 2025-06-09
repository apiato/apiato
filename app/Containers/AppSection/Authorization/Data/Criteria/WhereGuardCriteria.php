<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Data\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface;

final class WhereGuardCriteria extends ParentCriteria
{
    public function __construct(public readonly string $guard)
    {
    }

    /**
     * @param Builder $model
     */
    public function apply($model, RepositoryInterface $repository): Builder
    {
        return $model->where('guard_name', $this->guard);
    }
}
