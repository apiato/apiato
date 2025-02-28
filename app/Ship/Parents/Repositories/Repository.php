<?php

namespace App\Ship\Parents\Repositories;

use Apiato\Abstract\Repositories\Repository as AbstractRepository;
use App\Ship\Exceptions\ResourceCreationFailed;
use App\Ship\Exceptions\ResourceNotFound;
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
     * @var \Closure[]
     */
    protected array $scopes = [];

    public function __construct()
    {
        parent::__construct(app());
    }

    /**
     * Add a new global scope to the model.
     */
    public function scope(\Closure $scope): static
    {
        $this->scopes[] = $scope;

        return $this;
    }

    public function resetScope(): static
    {
        parent::resetScope();
        $this->resetScopes();

        return $this;
    }

    public function resetScopes(): static
    {
        $this->scopes = [];

        return $this;
    }

    /**
     * Find a model by its primary key.
     *
     * @return TModel|null
     */
    public function findById(int|string $id, array $columns = ['*'])
    {
        try {
            return $this->find($id, $columns);
        } catch (ModelNotFoundException) {
            return null;
        }
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @return TModel
     *
     * @throws ResourceNotFound
     */
    public function findByIdOrFail(int|string $id, array $columns = ['*'])
    {
        try {
            return $this->find($id, $columns);
        } catch (ModelNotFoundException) {
            throw ResourceNotFound::create();
        }
    }

    /**
     * Make a new instance of the Model and persist it to the storage.
     *
     * @return TModel
     *
     * @throws ResourceCreationFailed
     */
    public function create(array $attributes)
    {
        try {
            return parent::create($attributes);
        } catch (\Exception) {
            throw ResourceCreationFailed::create();
        }
    }

    /**
     * Find multiple models by their primary keys.
     *
     * @return Collection<array-key, TModel>
     */
    public function findMany(array|Arrayable $ids, array $columns = ['*']): Collection
    {
        try {
            return $this->find($ids, $columns);
        } catch (ModelNotFoundException) {
            return new Collection();
        }
    }

    /**
     * Delete the model from the database.
     *
     * @param int|string $id
     *
     * @throws ResourceNotFound
     */
    public function delete($id): bool
    {
        try {
            return (bool) parent::delete($id);
        } catch (ModelNotFoundException) {
            throw ResourceNotFound::create();
        }
    }

    /**
     * Make a new instance of the Model.
     *
     * @return TModel
     */
    public function make(array $attributes)
    {
        return $this->getModel()->newInstance($attributes);
    }

    /**
     * Returns the current Model instance.
     * *
     * @return TModel
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * Persist a Model instance to the database.
     *
     * @param TModel $model
     *
     * @return TModel
     */
    public function save($model)
    {
        $model->save();

        return $model;
    }

    /**
     * Persist an object with the given data if it passes the validation.
     *
     * TODO: a note to my future self,
     *  This method should not fire any non-repository related events.
     *
     * @template TData of Arrayable
     *
     * @param TData $data
     *
     * @return TModel
     *
     * @throws ResourceCreationFailed
     */
    public function store($data)
    {
        return $this->create($data->toArray());
    }

    /**
     * Get the first record matching the attributes. If the record is not found, create it.
     *
     * @return TModel
     */
    public function firstOrCreate(array $attributes = [], array $values = [])
    {
        /** @var TModel $model */
        $model = parent::firstOrCreate($attributes);
        if ($model->wasRecentlyCreated) {
            $model->update($values);
        }

        return $model;
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

    protected function applyScope(): static
    {
        parent::applyScope();
        $this->applyScopes();

        return $this;
    }

    protected function applyScopes(): static
    {
        foreach ($this->scopes as $scope) {
            if (!is_callable($scope)) {
                throw new \RuntimeException('Query scope is not callable');
            }
            $this->model = $scope($this->model);
        }

        return $this;
    }
}
