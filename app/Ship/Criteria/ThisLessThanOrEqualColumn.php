<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface;

final class ThisLessThanOrEqualColumn extends Criteria
{
    public function __construct(
        private readonly string $field,
        private readonly string|float|int $value,
    ) {
    }

    /**
     * @param Builder $model
     */
    public function apply($model, RepositoryInterface $repository): Builder
    {
        return $model->where($this->field, '<=', $this->value);
    }
}
