<?php

namespace App\Ship\Criterias;

use App\Ship\Parents\Criterias\Criteria as ParentCriteria;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class OrderByFieldCriteria extends ParentCriteria
{
    public function __construct(
        private string $field,
        private string $sortOrder,
    ) {
        if (!$this->isValidSortOrder($sortOrder)) {
            throw new \InvalidArgumentException("Invalid argument supplied. Valid arguments are 'asc' and 'desc'");
        }
    }

    private function isValidSortOrder(string $sortOrder): bool
    {
        $sortOrder = Str::lower($sortOrder);
        $availableDirections = [
            'asc',
            'desc',
        ];

        return in_array($sortOrder, $availableDirections, true);
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->orderBy($this->field, $this->sortOrder);
    }
}
