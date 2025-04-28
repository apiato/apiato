<?php

declare(strict_types=1);

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria as ParentCriteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class GroupByCriteria extends ParentCriteria
{
    public function __construct(private readonly string $field)
    {
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->groupBy($this->field);
    }
}
