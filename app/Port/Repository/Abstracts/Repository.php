<?php

namespace App\Port\Repository\Abstracts;

use Prettus\Repository\Contracts\CacheableInterface as PrettusCacheableInterface;
use Prettus\Repository\Criteria\RequestCriteria as PrettusRequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository as PrettusRepository;
use Prettus\Repository\Traits\CacheableRepository as PrettusCacheableRepository;

/**
 * Class Repository.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Repository extends PrettusRepository implements PrettusCacheableInterface
{

    use PrettusCacheableRepository;

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(PrettusRequestCriteria::class));
    }
}
