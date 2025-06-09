<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class OrderByFieldCriteria extends ParentCriteria
{
    public function __construct(
        private readonly string $field,
        private readonly string $sortOrder,
    ) {
        if (!$this->isValidSortOrder($this->sortOrder)) {
            throw new InvalidArgumentException("Invalid argument supplied. Valid arguments are 'asc' and 'desc'");
        }
    }

    /**
     * @param Builder $model
     */
    public function apply($model, PrettusRepositoryInterface $repository): Builder
    {
        return $model->orderBy($this->field, $this->sortOrder);
    }

    private function isValidSortOrder(string $sortOrder): bool
    {
        $sortOrder = Str::lower($sortOrder);
        $availableDirections = [
            'asc',
            'desc',
        ];

        return \in_array($sortOrder, $availableDirections, true);
    }
}
