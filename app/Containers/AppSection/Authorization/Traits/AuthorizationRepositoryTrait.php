<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Traits;

use App\Containers\AppSection\Authorization\Data\Criterias\WhereGuardCriteria;
use Illuminate\Contracts\Container\BindingResolutionException;
use Prettus\Repository\Exceptions\RepositoryException;

trait AuthorizationRepositoryTrait
{
    /**
     * @throws RepositoryException
     * @throws BindingResolutionException
     */
    public function whereGuard(null|string $guard): static
    {
        if ($guard !== null) {
            $this->pushCriteriaWith(WhereGuardCriteria::class, ['guard' => $guard]);
        }

        return $this;
    }
}
