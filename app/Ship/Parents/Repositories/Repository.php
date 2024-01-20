<?php

namespace App\Ship\Parents\Repositories;

use Apiato\Core\Abstracts\Repositories\Repository as AbstractRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Exceptions\RepositoryException;

abstract class Repository extends AbstractRepository
{
    public function delete($id): bool|null
    {
        $result = parent::delete($id);

        if (null === $result) {
            return null;
        }

        return (bool) $result;
    }

    /**
     * @param class-string<CriteriaInterface> $criteria Criteria class name
     * @param array<string, mixed> $args Arguments to pass to the criteria constructor
     *
     * @throws RepositoryException
     * @throws BindingResolutionException
     */
    public function pushCriteriaWith(string $criteria, array $args): static
    {
        /** @var CriteriaInterface $criteriaInstance */
        $criteriaInstance = $this->app->makeWith($criteria, $args);

        return $this->pushCriteria($criteriaInstance);
    }
}
