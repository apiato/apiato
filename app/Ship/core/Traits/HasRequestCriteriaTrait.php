<?php

namespace Apiato\Core\Traits;

use Apiato\Core\Abstracts\Repositories\Repository;
use Apiato\Core\Exceptions\CoreInternalErrorException;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Trait HasRequestCriteriaTrait
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
trait HasRequestCriteriaTrait
{

    /**
     * Adds the RequestCriteria to a Repository
     *
     * @param null $repository
     */
    public function addRequestCriteria($repository = null)
    {
        $validatedRepository = $this->validateRepository($repository);

        $validatedRepository->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Removes the RequestCriteria from a Repository
     *
     * @param null $repository
     */
    public function removeRequestCriteria($repository = null)
    {
        $validatedRepository = $this->validateRepository($repository);

        $validatedRepository->popCriteria(RequestCriteria::class);
    }

    /**
     * Validates, if the given Repository exists or uses $this->repository on the Task/Action to apply functions
     *
     * @param $repository
     *
     * @return mixed
     * @throws CoreInternalErrorException
     */
    private function validateRepository($repository)
    {
        $validatedRepository = $repository;

        // check if we have a "custom" repository
        if (null === $repository) {
            if (! isset($this->repository)) {
                throw new CoreInternalErrorException('No protected or public accessible repository available');
            }
            $validatedRepository = $this->repository;
        }

        // check, if the validated repository is null
        if (null === $validatedRepository) {
            throw new CoreInternalErrorException();
        }

        // check if it is a Repository class
        if (! ($validatedRepository instanceof Repository)) {
            throw new CoreInternalErrorException();
        }

        return $validatedRepository;
    }

}
