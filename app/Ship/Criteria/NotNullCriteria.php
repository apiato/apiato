<?php

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class NotNullCriteria extends ParentCriteria
{
    private string $field;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereNotNull($this->field);
    }
}
