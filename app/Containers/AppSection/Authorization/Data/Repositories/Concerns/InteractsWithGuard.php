<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Data\Repositories\Concerns;

use App\Containers\AppSection\Authorization\Data\Criteria\WhereGuardCriteria;
use Illuminate\Contracts\Container\BindingResolutionException;
use Prettus\Repository\Exceptions\RepositoryException;

trait InteractsWithGuard
{
    /**
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function whereGuard(null|string $guard): static
    {
        if ($guard !== null) {
            $this->pushCriteriaWith(WhereGuardCriteria::class, ['guard' => $guard]);
        }

        return $this;
    }
}
