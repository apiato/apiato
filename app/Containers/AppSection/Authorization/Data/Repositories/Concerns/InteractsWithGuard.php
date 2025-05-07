<?php

namespace App\Containers\AppSection\Authorization\Data\Repositories\Concerns;

use App\Containers\AppSection\Authorization\Data\Criteria\WhereGuardCriteria;

trait InteractsWithGuard
{
    public function whereGuard(string|null $guard): static
    {
        if (null !== $guard) {
            $this->pushCriteriaWith(WhereGuardCriteria::class, compact('guard'));
        }

        return $this;
    }
}
