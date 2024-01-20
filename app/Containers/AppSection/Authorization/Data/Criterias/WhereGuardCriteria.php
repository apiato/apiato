<?php

namespace App\Containers\AppSection\Authorization\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria as ParentCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

class WhereGuardCriteria extends ParentCriteria
{
    public function __construct(
        private readonly string $guard,
    ) {
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('guard_name', $this->guard);
    }
}
