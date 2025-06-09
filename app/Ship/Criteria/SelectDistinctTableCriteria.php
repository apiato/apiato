<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class SelectDistinctTableCriteria extends ParentCriteria
{
    public function __construct(private readonly ?array $fields = null)
    {
    }

    /**
     * @param Builder $model
     */
    public function apply($model, PrettusRepositoryInterface $repository): Builder
    {
        $table = $model->getModel()->getTable();

        $fields = $this->fields === null || $this->fields === [] ? $table . '.*' : array_map(static fn (string $field): string => \sprintf('%s.%s', $table, $field), $this->fields);

        return $model->select($fields)->distinct();
    }
}
