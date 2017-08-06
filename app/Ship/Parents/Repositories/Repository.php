<?php

namespace App\Ship\Parents\Repositories;

use Apiato\Core\Abstracts\Repositories\Repository as AbstractRepository;

/**
 * Class Repository.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
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
