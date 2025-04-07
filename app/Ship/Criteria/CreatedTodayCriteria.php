<?php

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Illuminate\Support\Facades\Date;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class CreatedTodayCriteria extends ParentCriteria
{
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('created_at', '>=', Date::today()->toIso8601String());
    }
}
