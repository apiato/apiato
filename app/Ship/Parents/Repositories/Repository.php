<?php

namespace App\Ship\Parents\Repositories;

use Apiato\Core\Abstracts\Repositories\Repository as AbstractRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * @template TModel of Model
 */
abstract class Repository extends AbstractRepository
{
    /**
     * @return Collection<array-key, TModel>
     *
     * @throws NotFoundException
     */
    public function findManyOrFail(array|Arrayable $ids, array $columns = ['*']): Collection
    {
        try {
            return parent::find($ids, $columns);
        } catch (\Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @param int|string $id
     * @param array $columns
     *
     * @return TModel|null
     */
    public function find($id, $columns = ['*'])
    {
        try {
            return parent::find($id, $columns);
        } catch (\Exception) {
            return null;
        }
    }

    /**
     * @return TModel
     *
     * @throws NotFoundException
     */
    public function findOrFail(int|string $id, array $columns = ['*'])
    {
        try {
            return parent::find($id, $columns);
        } catch (\Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @return Collection<array-key, TModel>
     */
    public function findMany(array|Arrayable $ids, array $columns = ['*']): Collection
    {
        try {
            return parent::find($ids, $columns);
        } catch (\Exception) {
            return new Collection();
        }
    }

    /**
     * @param int|string $id
     *
     * @throws NotFoundException
     * @throws DeleteResourceFailedException
     */
    public function delete($id): bool
    {
        try {
            $this->findOrFail($id);

            return (bool) parent::delete($id);
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (\Exception) {
            throw new DeleteResourceFailedException();
        }
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
