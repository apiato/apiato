<?php

declare(strict_types=1);

namespace App\Ship\Criteria;

use App\Ship\Parents\Criteria\Criteria as ParentCriteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class OrderBySeveralFieldsCriteria extends ParentCriteria
{
    public function __construct(
        private readonly string $field,
        private readonly array $values,
    ) {
    }

    /**
     * @param Builder $model
     */
    public function apply($model, PrettusRepositoryInterface $repository): Builder
    {
        if ($this->values === []) {
            return $model;
        }

        $field = $model->getModel()->getConnection()->getQueryGrammar()->wrap($this->field);

        $cases = [];
        $bindings = [];

        foreach ($this->values as $index => $value) {
            $cases[] = \sprintf('WHEN %s = ? THEN ?', $field);
            $bindings[] = $value;
            $bindings[] = $index;
        }

        $caseStatement = 'CASE ' . implode(' ', $cases) . ' ELSE ? END';
        $bindings[] = \count($this->values) + 1;

        return $model->orderByRaw($caseStatement, $bindings);
    }
}
