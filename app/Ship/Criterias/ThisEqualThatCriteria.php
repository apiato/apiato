<?php

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria as ParentCriteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class ThisEqualThatCriteria extends ParentCriteria
{
    public function __construct(
        private string $field,
        private string $value,
    ) {
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where($this->field, $this->value);
    }
}
