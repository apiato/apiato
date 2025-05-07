<?php

namespace App\Containers\AppSection\Authorization\Data\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

final class WhereGuardCriteria extends ParentCriteria
{
    public function __construct(
        public readonly string $guard,
    ) {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('guard_name', $this->guard);
    }
}
