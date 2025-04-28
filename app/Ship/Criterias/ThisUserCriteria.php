<?php

declare(strict_types=1);

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria as ParentCriteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class ThisUserCriteria extends ParentCriteria
{
    public function __construct(private readonly int $userId)
    {
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('user_id', '=', $this->userId);
    }
}
