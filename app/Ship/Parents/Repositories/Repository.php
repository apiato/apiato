<?php

namespace App\Ship\Parents\Repositories;

use Apiato\Core\Abstracts\Repositories\Repository as AbstractRepository;

abstract class Repository extends AbstractRepository
{
    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        parent::boot();
    }
}
