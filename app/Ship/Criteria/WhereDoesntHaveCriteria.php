<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria;
use Illuminate\Database\Eloquent\Builder;
use InvalidArgumentException;
use Prettus\Repository\Contracts\RepositoryInterface;

final class WhereDoesntHaveCriteria extends Criteria
{
    public function __construct(
        private readonly string $relation,
        private readonly string $relationColumn,
        private readonly string $condition,
        private readonly mixed $value,
    ) {
        if ($this->relation === '') {
            throw new InvalidArgumentException('The relation must not be empty.');
        }

        if ($this->relationColumn === '') {
            throw new InvalidArgumentException('The relation column must not be empty.');
        }

        if (!\in_array($this->condition, ['=', '!=', '<', '>', '<=', '>=', 'like', 'not like'], true)) {
            throw new InvalidArgumentException('Invalid condition provided.');
        }
    }

    /**
     * @param Builder $model
     */
    public function apply($model, RepositoryInterface $repository): Builder
    {
        return $model->whereDoesntHave($this->relation, function (Builder $query): void {
            $query->where($this->relationColumn, $this->condition, $this->value);
        });
    }
}
